<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{

  protected $table = 'asignaciones';
    public function dispositivo() {
    return $this->belongsTo(Dispositivo::class);
}
public function empleado() {
    return $this->belongsTo(Empleado::class);
}
}
