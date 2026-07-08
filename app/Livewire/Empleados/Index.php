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
        if (auth()->user()->rol !== 'admin') {
            abort(403);
        }

        $empleado = Empleado::find($id);
        if ($empleado) {
            $empleado->delete();
            session()->flash('message', 'Empleado eliminado correctamente.');
        }
    }

    public function render()
    {
        try {
            $empleados = Empleado::withCount(['asignaciones as pendientes_count' => function ($q) {
                    $q->whereIn('estado', ['activo', 'pendiente_devolver']);
                }])
                ->where('primer_nombre', 'like', '%' . $this->search . '%')
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