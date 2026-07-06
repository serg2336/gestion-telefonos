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
        $departamento = Departamento::find($id);
        if ($departamento) {
            $departamento->delete();
            session()->flash('message', 'Departamento eliminado correctamente.');
        }
    }

    public function render()
    {
           
     // 👈 Esto detendrá la ejecución y mostrará los datos.
        $departamentos = Departamento::where('nombre', 'like', '%' . $this->search . '%')
                                     ->orWhere('descripcion', 'like', '%' . $this->search . '%')
                                     ->paginate(10);
     
        return view('livewire.departamentos.index', compact('departamentos'));
    }
}