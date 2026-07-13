<?php

namespace App\Http\Controllers\Api;

use App\Models\Empleado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmpleadoController extends Controller
{
    // Listar todos los empleados
    public function index()
    {
        $empleados = Empleado::with('departamento')->get();
        return response()->json($empleados);
    }

    // Mostrar un empleado específico
    public function show($id)
    {
        $empleado = Empleado::with(['departamento', 'asignaciones.dispositivo'])->find($id);
        
        if (!$empleado) {
            return response()->json(['message' => 'Empleado no encontrado'], 404);
        }

        return response()->json($empleado);
    }

    // Crear un nuevo empleado
    public function store(Request $request)
    {
        $validated = $request->validate([
            'primer_nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:empleados,email',
            'telefono' => 'required|string|max:20',
            'identificacion' => 'nullable|string|max:50',
            'departamento_id' => 'nullable|exists:departamentos,id',
        ]);

        $empleado = Empleado::create($validated);
        return response()->json($empleado, 201);
    }

    // Actualizar un empleado
    public function update(Request $request, $id)
    {
        $empleado = Empleado::find($id);
        
        if (!$empleado) {
            return response()->json(['message' => 'Empleado no encontrado'], 404);
        }

        $validated = $request->validate([
            'primer_nombre' => 'sometimes|string|max:255',
            'apellido' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:empleados,email,' . $id,
            'telefono' => 'sometimes|string|max:20',
            'identificacion' => 'nullable|string|max:50',
            'departamento_id' => 'nullable|exists:departamentos,id',
        ]);

        $empleado->update($validated);
        return response()->json($empleado);
    }

    // Eliminar un empleado (soft delete o físico)
    public function destroy($id)
    {
        $empleado = Empleado::find($id);
        
        if (!$empleado) {
            return response()->json(['message' => 'Empleado no encontrado'], 404);
        }

        $empleado->delete();
        return response()->json(null, 204);
    }
}