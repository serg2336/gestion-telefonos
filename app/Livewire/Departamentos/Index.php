<?php

namespace App\Livewire\Departamentos;

use App\Models\Departamento;
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

        $departamento = Departamento::withCount('empleados')->find($id);
        if (!$departamento) {
            return;
        }

        if ($departamento->empleados_count > 0) {
            session()->flash('error', 'No se puede eliminar el departamento porque tiene empleados asignados.');
            return;
        }

        $departamento->delete();
        session()->flash('message', 'Departamento eliminado correctamente.');
    }

    public function render()
    {
        $departamentos = Departamento::query();

        if ($this->search) {
            $departamentos->where(function ($q) {
                $q->where('nombre', 'like', '%' . $this->search . '%')
                  ->orWhere('descripcion', 'like', '%' . $this->search . '%');
            });
        }

        $departamentos = $departamentos->paginate(10);

        return view('livewire.departamentos.index', compact('departamentos'));
    }
}