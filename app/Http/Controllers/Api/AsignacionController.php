<?php

namespace App\Http\Controllers\Api;

use App\Models\Asignacion;
use App\Http\Controllers\Controller;
use App\Http\Resources\AsignacionResource;
use Illuminate\Http\Request;

class AsignacionController extends Controller
{
    public function index()
    {
        return AsignacionResource::collection(
            Asignacion::with(['empleado', 'dispositivo'])
                ->latest('fecha_asignacion')
                ->paginate(20)
        );
    }

    public function show($id)
    {
        $asignacion = Asignacion::with(['empleado', 'dispositivo'])->findOrFail($id);
        return new AsignacionResource($asignacion);
    }
}
