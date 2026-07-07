<?php

namespace App\Livewire;

use App\Models\Empleado;
use App\Models\Dispositivo;
use App\Models\Asignacion;
use Livewire\Component;
use Livewire\Attributes\Layout; // 👈 Importante

#[Layout('layouts.app')] // 👈 Usa el layout de Breeze (con menú y header)
class Dashboard extends Component
{
    public function render()
    {
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
        ]);
    }
}