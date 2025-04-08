<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Period;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Middleware\AdminOnly;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $query = Media::query();

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $medios = $query->paginate(10);

        if ($request->wantsJson()) {
            return response()->json($medios);
        }

        return Inertia::render('Admin/Media/Index', [
            'medios' => $medios,
            'filters' => $request->only(['location', 'type']),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'tipo' => 'required|in:espectacular,pantalla,valla,otro',
            'precio_por_dia' => 'required|numeric|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('medios', 'public');
        }

        Media::create($data);

        return redirect()->route('admin.dashboard')->with('success', 'Medio creado con éxito');
    }

    public function update(Request $request, Media $media)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'tipo' => 'required|in:espectacular,pantalla,valla,otro',
            'precio_por_dia' => 'required|numeric|min:0',
        ]);

        $media->update($request->all());

        return redirect()->route('admin.dashboard')->with('success', 'Medio actualizado');
    }

    public function destroy(Media $media)
    {
        $media->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Medio eliminado');
    }
    
    public function fechasReservadas(Media $media)
    {
        $fechas = [];

        foreach ($media->reservations as $reserva) {
            $periodo = Period::create($reserva->fecha_inicio, $reserva->fecha_fin);

            foreach ($periodo as $fecha) {
                $fechas[] = $fecha->format('Y-m-d');
            }
        }

        return response()->json($fechas);
    }
    public function fechasOcupadas(Media $media)
    {
        $media->load('reservations');

        $fechas = [];

        foreach ($media->reservations as $reserva) {
            if (!$reserva->fecha_inicio || !$reserva->fecha_fin) {
                continue;
            }

            try {
                $inicio = new \DateTime($reserva->fecha_inicio);
                $fin = (new \DateTime($reserva->fecha_fin))->modify('+1 day');

                $periodo = new \DatePeriod($inicio, new \DateInterval('P1D'), $fin);

                foreach ($periodo as $fecha) {
                    $fechas[] = $fecha->format('Y-m-d');
                }
            } catch (\Exception $e) {
                logger()->error('Error al generar fechas ocupadas: ' . $e->getMessage());
            }
        }

        return response()->json($fechas);
    }

    public function show(Media $media)
    {
        return Inertia::render('Media/Show', [
            'media' => $media
        ]);
        
    }
    

    public function catalogo()
    {
        $medios = Media::latest()->paginate(10);
    
        return Inertia::render('Client/Catalogo', [
            'medios' => $medios,
        ]);
    }
    
}
