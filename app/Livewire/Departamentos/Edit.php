<?php

namespace App\Livewire\Departamentos;

use App\Models\Departamento;
use Livewire\Component;

class Edit extends Component
{
    public $departamento_id;
    public $nombre;
    public $descripcion;

    public function mount($id)
    {
        $departamento = Departamento::findOrFail($id);
        $this->departamento_id = $departamento->id;
        $this->nombre = $departamento->nombre;
        $this->descripcion = $departamento->descripcion;
    }

    protected $rules = [
        'nombre' => 'required|string|max:255|unique:departamentos,nombre,{departamento_id}',
        'descripcion' => 'nullable|string|max:500',
    ];

    public function update()
    {
        $this->validate([
            'nombre' => 'required|string|max:255|unique:departamentos,nombre,' . $this->departamento_id,
            'descripcion' => 'nullable|string|max:500',
        ]);

        Departamento::find($this->departamento_id)->update([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
        ]);

        session()->flash('message', 'Departamento actualizado correctamente.');
        return redirect()->route('departamentos.index');
    }

    public function render()
    {
        return view('livewire.departamentos.edit');
    }
}