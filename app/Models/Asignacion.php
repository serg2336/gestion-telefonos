<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    protected $table = 'asignaciones';

    protected $fillable = [
        'dispositivo_id',
        'empleado_id',
        'fecha_asignacion',
        'fecha_devolucion',
        'estado',
        'observaciones',
    ];

    protected $casts = [
        'fecha_asignacion' => 'datetime',
        'fecha_devolucion' => 'datetime',
    ];

    public function dispositivo()
    {
        return $this->belongsTo(Dispositivo::class);
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
}
