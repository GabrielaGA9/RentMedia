<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Media;
use Inertia\Inertia;
use App\Jobs\ProcesarPagoSimulado;
use Illuminate\Foundation\Bus\Dispatchable;


class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'media_id' => 'required|exists:media,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        $media = Media::findOrFail($data['media_id']);

        // Lógica para verificar disponibilidad (puedes mejorarla)
        $ocupado = $media->reservations()->where(function ($query) use ($data) {
            $query->whereBetween('fecha_inicio', [$data['fecha_inicio'], $data['fecha_fin']])
                    ->orWhereBetween('fecha_fin', [$data['fecha_inicio'], $data['fecha_fin']]);
        })->exists();

        if ($ocupado) {
            return response()->json(['message' => 'El medio ya está reservado en esas fechas.'], 422);
        }

        $days = (new \DateTime($data['fecha_inicio']))->diff(new \DateTime($data['fecha_fin']))->days + 1;
        $total = $days * $media->precio_por_dia;

        $reservation = $request->user()->reservations()->create([
            'media_id' => $media->id,
            'fecha_inicio' => $data['fecha_inicio'],
            'fecha_fin' => $data['fecha_fin'],
            'total' => $total,
        ]);
        $job = new ProcesarPagoSimulado($reservation);
        $job->handle(); 

        return response()->json([
            'message' => 'Reserva exitosa',
            'reservation' => $reservation,
        ]);
        
    }


    private function calcularTotal($inicio, $fin, $media_id)
    {
        $dias = (new \DateTime($fin))->diff(new \DateTime($inicio))->days + 1;
        $precio = \App\Models\Media::findOrFail($media_id)->precio_por_dia;
        return $dias * $precio;
    }
    public function historial()
    {
        $reservas = auth()->user()->reservations()->with('media')->latest()->get();

        return Inertia::render('Client/HistorialReservas', [
            'reservas' => $reservas,
        ]);
    }
}
