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

        $asignacionesPorMes = Asignacion::selectRaw('MONTH(fecha_asignacion) as mes, YEAR(fecha_asignacion) as año, count(*) as total')
            ->groupBy('año', 'mes')
            ->orderBy('año')
            ->orderBy('mes')
            ->get();

        $labels = [];
        $data = [];
        foreach ($asignacionesPorMes as $item) {
            $labels[] = $item->año . '-' . str_pad($item->mes, 2, '0', STR_PAD_LEFT);
            $data[] = $item->total;
        }

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