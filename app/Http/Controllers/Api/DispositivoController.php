<?php

namespace App\Http\Controllers\Api;

use App\Models\Dispositivo;
use App\Http\Controllers\Controller;
use App\Http\Resources\DispositivoResource;
use Illuminate\Http\Request;

class DispositivoController extends Controller
{
    public function index()
    {
        return DispositivoResource::collection(Dispositivo::with('asignacionActiva')->paginate(20));
    }

    public function show($id)
    {
        $dispositivo = Dispositivo::with(['asignacionActiva', 'asignaciones.empleado'])->findOrFail($id);
        return new DispositivoResource($dispositivo);
    }
}
