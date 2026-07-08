<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'primer_nombre',
        'apellido',
        'email',
        'telefono',
        'departamento_id',
        'identificacion',
    ];


    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function asignaciones()
    {
        return $this->hasMany(Asignacion::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function asignacionesPendientes()
    {
        return $this->asignaciones()->whereIn('estado', ['activo', 'pendiente_devolver']);
    }

    public function tienePendientes(): bool
    {
        return $this->asignacionesPendientes()->exists();
    }
}
