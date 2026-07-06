<?php

namespace App\Livewire\Empleados;

use App\Models\Empleado;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Edit extends Component
{
    // 👇 Propiedades para almacenar los datos del empleado
    public $empleado_id;
    public $primer_nombre;
    public $apellido;
    public $email;
    public $telefono;
    public $identificacion;
    public $departamento_id; // 👈 Para el departamento

    // 👇 Se ejecuta al cargar el componente, recibe el ID de la URL
    public function mount($id)
    {
        $empleado = Empleado::findOrFail($id);
        $this->empleado_id = $empleado->id;
        $this->primer_nombre = $empleado->primer_nombre;
        $this->apellido = $empleado->apellido;
        $this->email = $empleado->email;
        $this->telefono = $empleado->telefono;
        $this->identificacion = $empleado->identificacion;
        $this->departamento_id = $empleado->departamento_id;
    }

    // 👇 Reglas de validación
    protected $rules = [
        'primer_nombre' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'email' => 'required|email|unique:empleados,email,{empleado_id}',
        'telefono' => 'required|string|max:20',
        'identificacion' => 'nullable|string|max:50',
        'departamento_id' => 'nullable|exists:departamentos,id',
    ];

    // 👇 Método que se ejecuta al enviar el formulario
    public function update()
    {
        // Validar (se ajusta la regla de email para ignorar el registro actual)
        $this->validate([
            'primer_nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:empleados,email,' . $this->empleado_id,
            'telefono' => 'required|string|max:20',
            'identificacion' => 'nullable|string|max:50',
            'departamento_id' => 'nullable|exists:departamentos,id',
        ]);

        // Actualizar el empleado
        Empleado::find($this->empleado_id)->update([
            'primer_nombre' => $this->primer_nombre,
            'apellido' => $this->apellido,
            'email' => $this->email,
            'telefono' => $this->telefono,
            'identificacion' => $this->identificacion,
            'departamento_id' => $this->departamento_id,
        ]);

        session()->flash('message', 'Empleado actualizado correctamente.');
        return redirect()->route('empleados.index');
    }

    public function render()
    {
        return view('livewire.empleados.edit');
    }
}