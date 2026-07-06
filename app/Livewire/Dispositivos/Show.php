<?php

namespace App\Livewire\Dispositivos;

use App\Models\Dispositivo;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Show extends Component
{
    public $dispositivo;

    public function mount($id)
    {
        $this->dispositivo = Dispositivo::with(['asignaciones.empleado'])->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.dispositivos.show');
    }
}
