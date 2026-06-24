<?php

namespace App\Livewire\Empleados;

use App\Models\Empleado;
use Livewire\Component;

class Edit extends Component
{
    public $empleado_id;
    public $primer_nombre;
    public $apellido;
    public $email;
    public $telefono;
    public $identificacion;

    public function mount($id)
    {
        $empleado = Empleado::findOrFail($id);
        $this->empleado_id = $empleado->id;
        $this->primer_nombre = $empleado->primer_nombre;
        $this->apellido = $empleado->apellido;
        $this->email = $empleado->email;
        $this->telefono = $empleado->telefono;
        $this->identificacion = $empleado->identificacion;
    }

    public function update()
    {
        $this->validate([
            'primer_nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:empleados,email,' . $this->empleado_id,
            'telefono' => 'required|string|max:20',
            'identificacion' => 'nullable|string|max:50',
        ]);

        Empleado::find($this->empleado_id)->update([
            'primer_nombre' => $this->primer_nombre,
            'apellido' => $this->apellido,
            'email' => $this->email,
            'telefono' => $this->telefono,
            'identificacion' => $this->identificacion,
        ]);

        session()->flash('message', 'Empleado actualizado correctamente.');
        return redirect()->route('empleados.index');
    }

    public function render()
    {
        return view('livewire.empleados.edit');
    }
}