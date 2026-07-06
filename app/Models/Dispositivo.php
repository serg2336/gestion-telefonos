<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Asignacion;

class Dispositivo extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'marca',
        'modelo',
        'numero_serie',
        'imei',
        'estado',
        'fecha_compra',
        'observaciones',
    ];

    protected $casts = [
        'fecha_compra' => 'date',
    ];

    public function asignaciones()
    {
        return $this->hasMany(Asignacion::class);
    }

    public function asignacionActiva()
    {
        return $this->hasOne(Asignacion::class)
            ->where('estado', 'activo');
    }
}