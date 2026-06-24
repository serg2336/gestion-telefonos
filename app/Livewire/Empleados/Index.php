<?php

namespace App\Livewire\Empleados;

use App\Models\Empleado;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function delete($id)
    {
        $empleado = Empleado::find($id);
        if ($empleado) {
            $empleado->delete();
            session()->flash('message', 'Empleado eliminado correctamente.');
        }
    }

    public function render()
    {
        try {
            $empleados = Empleado::where('primer_nombre', 'like', '%' . $this->search . '%')
                                 ->orWhere('apellido', 'like', '%' . $this->search . '%')
                                 ->orWhere('email', 'like', '%' . $this->search . '%')
                                 ->orWhere('telefono', 'like', '%' . $this->search . '%')
                                 ->orWhere('identificacion', 'like', '%' . $this->search . '%')
                                 ->paginate(10);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        return view('livewire.empleados.index', compact('empleados'));
    }
}