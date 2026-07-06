<?php

namespace App\Livewire\Departamentos;

use App\Models\Departamento;
use Livewire\Component;
use Livewire\Attributes\Layout; // 👈 Importante agregar esta línea

#[Layout('layouts.app')] 
class Create extends Component
{
    public $nombre = '';
    public $descripcion = '';

    protected $rules = [
        'nombre' => 'required|string|max:255|unique:departamentos,nombre',
        'descripcion' => 'nullable|string|max:500',
    ];

    public function save()
    {
        $this->validate();

        Departamento::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
        ]);

        session()->flash('message', 'Departamento creado correctamente.');
        return redirect()->route('departamentos.index');
    }

    public function render()
    {
        return view('livewire.departamentos.create');
    }
}