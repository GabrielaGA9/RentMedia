<?php

namespace App\Models;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'nombre',
        'ubicacion',
        'tipo',
        'imagen',
        'precio_por_dia',
    ];
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

}
