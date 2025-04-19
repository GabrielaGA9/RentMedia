@component('mail::message')
# ¡Gracias por tu reserva, {{ $reserva->user->name }}!

Has reservado el medio **{{ $reserva->media->nombre }}** del  
**{{ \Carbon\Carbon::parse($reserva->fecha_inicio)->format('d M Y') }}** al  
**{{ \Carbon\Carbon::parse($reserva->fecha_fin)->format('d M Y') }}**  
por un total de **${{ number_format($reserva->total, 2) }} MXN**

@component('mail::button', ['url' => route('reservas.historial')])
Ver mis reservas
@endcomponent

Gracias por confiar en RentMedia.
@endcomponent
