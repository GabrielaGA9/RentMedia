<?php

namespace App\Jobs;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcesarPagoSimulado implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $reserva;

    public function __construct(Reservation $reserva)
    {
        $this->reserva = $reserva;
    }

    public function handle()
    {
        sleep(5); // Simula procesamiento
        Log::info("✅ Pago simulado para reserva ID: {$this->reserva->id}");
    }
}
