<?php

namespace App\Livewire\Empleados;

use App\Models\Empleado;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Create extends Component
{
    public $primer_nombre = '';
    public $apellido = '';
    public $email = '';
    public $telefono = '';
    public $identificacion = '';
    public $departamento_id = '';

    protected $rules = [
        'primer_nombre' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'email' => 'required|email|unique:empleados,email',
        'telefono' => 'required|string|max:20',
        'identificacion' => 'required|string|max:50|unique:empleados,identificacion',
        'departamento_id' => 'nullable|exists:departamentos,id',
    ];

    public function save()
    {
        $this->validate();

        Empleado::create([
            'primer_nombre' => $this->primer_nombre,
            'apellido' => $this->apellido,
            'email' => $this->email,
            'telefono' => $this->telefono,
            'identificacion' => $this->identificacion,
             'departamento_id' => $this->departamento_id,
        ]);

        session()->flash('message', 'Empleado creado correctamente.');
        return redirect()->route('empleados.index');
    }

    public function render()
    {
        return view('livewire.empleados.create');
    }
}