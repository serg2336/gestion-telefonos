<?php

namespace App\Http\Controllers\Api;

use App\Models\Asignacion;
use App\Models\Dispositivo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AsignacionController extends Controller
{
    public function index()
    {
        $asignaciones = Asignacion::with(['empleado', 'dispositivo'])->get();
        return response()->json($asignaciones);
    }

    public function show($id)
    {
        $asignacion = Asignacion::with(['empleado', 'dispositivo'])->find($id);
        
        if (!$asignacion) {
            return response()->json(['message' => 'Asignación no encontrada'], 404);
        }

        return response()->json($asignacion);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'dispositivo_id' => 'required|exists:dispositivos,id',
            'fecha_asignacion' => 'nullable|date',
            'fecha_devolucion' => 'nullable|date|after_or_equal:fecha_asignacion',
            'estado' => 'required|in:activo,devuelto',
            'observaciones' => 'nullable|string',
        ]);

        // Verificar que el dispositivo esté disponible
        $dispositivo = Dispositivo::find($validated['dispositivo_id']);
        if ($dispositivo->estado !== 'disponible') {
            return response()->json(['message' => 'El dispositivo no está disponible'], 422);
        }

        $asignacion = Asignacion::create($validated);

        // Actualizar estado del dispositivo
        $dispositivo->estado = 'asignado';
        $dispositivo->save();

        return response()->json($asignacion, 201);
    }

    public function update(Request $request, $id)
    {
        $asignacion = Asignacion::find($id);
        
        if (!$asignacion) {
            return response()->json(['message' => 'Asignación no encontrada'], 404);
        }

        $validated = $request->validate([
            'empleado_id' => 'sometimes|exists:empleados,id',
            'dispositivo_id' => 'sometimes|exists:dispositivos,id',
            'fecha_asignacion' => 'sometimes|date',
            'fecha_devolucion' => 'nullable|date|after_or_equal:fecha_asignacion',
            'estado' => 'sometimes|in:activo,devuelto',
            'observaciones' => 'nullable|string',
        ]);

        // Si se devuelve el dispositivo, cambiar estado a disponible
        if (isset($validated['estado']) && $validated['estado'] === 'devuelto') {
            $dispositivo = Dispositivo::find($asignacion->dispositivo_id);
            if ($dispositivo) {
                $dispositivo->estado = 'disponible';
                $dispositivo->save();
            }
        }

        $asignacion->update($validated);
        return response()->json($asignacion);
    }

    public function destroy($id)
    {
        $asignacion = Asignacion::find($id);
        
        if (!$asignacion) {
            return response()->json(['message' => 'Asignación no encontrada'], 404);
        }

        // Liberar el dispositivo antes de eliminar la asignación
        $dispositivo = Dispositivo::find($asignacion->dispositivo_id);
        if ($dispositivo && $dispositivo->estado === 'asignado') {
            $dispositivo->estado = 'disponible';
            $dispositivo->save();
        }

        $asignacion->delete();
        return response()->json(null, 204);
    }
}