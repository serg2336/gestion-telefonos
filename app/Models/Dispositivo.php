<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Asignacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dispositivo extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'marca',
        'modelo',
        'numero_serie',
        'imei',
        'estado',
        'fecha_compra',
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