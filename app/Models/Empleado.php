<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{

    protected $fillable = [
        'primer_nombre',
        'apellido',
        'email',
        'telefono',
        'departamento_id',
        'identificacion',
    ];


    public function departamento() {
    return $this->belongsTo(Departamento::class);
}
public function asignaciones() {
    return $this->hasMany(Asignacion::class);
}
}
