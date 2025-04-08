<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'media_id',
        'fecha_inicio',
        'fecha_fin',
        'total',
    ];

    public function media() {
        return $this->belongsTo(Media::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}
