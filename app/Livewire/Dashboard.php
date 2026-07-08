<?php

namespace App\Livewire;

use App\Models\Empleado;
use App\Models\Dispositivo;
use App\Models\Asignacion;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Dashboard extends Component
{
    public function render()
    {
        $user = auth()->user();

        if ($user->rol === 'admin') {
            $totalEmpleados = Empleado::count();
            $totalDispositivos = Dispositivo::count();
            $asignacionesActivas = Asignacion::where('estado', 'activo')->count();

            $ultimasAsignaciones = Asignacion::with(['empleado', 'dispositivo'])
                ->latest()
                ->take(5)
                ->get();

            $asignaciones = Asignacion::select('fecha_asignacion')->get();
            $agrupadas = $asignaciones->groupBy(fn($item) => $item->fecha_asignacion->format('Y-m'))
                ->sortKeys();

            $labels = $agrupadas->keys()->toArray();
            $data = $agrupadas->map(fn($group) => $group->count())->values()->toArray();

            return view('livewire.dashboard', [
                'totalEmpleados' => $totalEmpleados,
                'totalDispositivos' => $totalDispositivos,
                'asignacionesActivas' => $asignacionesActivas,
                'ultimasAsignaciones' => $ultimasAsignaciones,
                'labels' => $labels,
                'data' => $data,
                'esAdmin' => true,
            ]);
        }

        $empleado = $user->empleado;
        $asignacionActiva = null;

        if ($empleado) {
            $asignacionActiva = $empleado->asignaciones()
                ->with('dispositivo')
                ->whereIn('estado', ['activo', 'pendiente_devolver'])
                ->latest('fecha_asignacion')
                ->first();
        }

        return view('livewire.dashboard', [
            'esAdmin' => false,
            'empleado' => $empleado,
            'asignacionActiva' => $asignacionActiva,
        ]);
    }
}