<?php

namespace App\Http\Controllers\Api;

use App\Models\Empleado;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmpleadoResource;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function index()
    {
        return EmpleadoResource::collection(Empleado::with('departamento')->paginate(20));
    }

    public function show($id)
    {
        $empleado = Empleado::with(['departamento', 'asignaciones.dispositivo'])->findOrFail($id);
        return new EmpleadoResource($empleado);
    }
}
