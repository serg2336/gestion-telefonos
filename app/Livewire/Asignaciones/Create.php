<?php

namespace App\Livewire\Asignaciones;

use App\Models\Asignacion;
use App\Models\Dispositivo;
use App\Models\Empleado;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Create extends Component
{
    public $empleado_id = '';
    public $dispositivo_id = '';
    public $observaciones = '';

    protected $rules = [
        'empleado_id' => 'required|exists:empleados,id',
        'dispositivo_id' => 'required|exists:dispositivos,id',
        'observaciones' => 'nullable|string|max:1000',
    ];

    public function save()
    {
        $this->validate();

        $empleado = Empleado::findOrFail($this->empleado_id);

        if ($empleado->tienePendientes()) {
            session()->flash('error', 'Este empleado tiene dispositivos pendientes de devolver. No se puede realizar una nueva asignación.');
            return;
        }

        $dispositivo = Dispositivo::findOrFail($this->dispositivo_id);

        if ($dispositivo->estado !== 'disponible') {
            session()->flash('error', 'El dispositivo no está disponible. Estado actual: ' . $dispositivo->estado);
            return;
        }

        Asignacion::create([
            'dispositivo_id' => $this->dispositivo_id,
            'empleado_id' => $this->empleado_id,
            'fecha_asignacion' => now(),
            'estado' => 'activo',
            'observaciones' => $this->observaciones,
        ]);

        $dispositivo->update(['estado' => 'asignado']);

        session()->flash('message', 'Dispositivo asignado correctamente.');
        return redirect()->route('asignaciones.index');
    }

    public function render()
    {
        $empleados = Empleado::orderBy('primer_nombre')->get();
        $dispositivos = Dispositivo::where('estado', 'disponible')->orderBy('marca')->get();

        return view('livewire.asignaciones.create', compact('empleados', 'dispositivos'));
    }
}
