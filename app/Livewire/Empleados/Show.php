<?php

namespace App\Livewire\Empleados;

use App\Models\Empleado;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Show extends Component
{
    public $empleado;

    public function mount($id)
    {
        $this->empleado = Empleado::with(['departamento', 'asignaciones.dispositivo'])->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.empleados.show');
    }
}
