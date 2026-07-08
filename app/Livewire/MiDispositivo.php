<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class MiDispositivo extends Component
{
    public function render()
    {
        $user = auth()->user();

        $empleado = $user->empleado;

        $asignacionActiva = null;
        $historial = collect();

        if ($empleado) {
            $asignacionActiva = $empleado->asignaciones()
                ->with('dispositivo')
                ->whereIn('estado', ['activo', 'pendiente_devolver'])
                ->latest('fecha_asignacion')
                ->first();

            $historial = $empleado->asignaciones()
                ->with('dispositivo')
                ->latest('fecha_asignacion')
                ->get();
        }

        return view('livewire.mi-dispositivo', [
            'empleado' => $empleado,
            'asignacionActiva' => $asignacionActiva,
            'historial' => $historial,
        ]);
    }
}
