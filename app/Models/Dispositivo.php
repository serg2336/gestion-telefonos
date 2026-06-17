<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Asignacion;

class Dispositivo extends Model
{
    public function asignaciones() {
        return $this->hasMany(Asignacion::class);
    }

    public function asignacionActiva() {
        return $this->hasOne(Asignacion::class)->where('estado', 'activo');
    }
}