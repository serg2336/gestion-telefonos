<?php

namespace App\Livewire\Dispositivos;

use App\Models\Dispositivo;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Create extends Component
{
    public $marca = '';
    public $modelo = '';
    public $numero_serie = '';
    public $imei = '';
    public $estado = 'disponible';
    public $fecha_compra = '';
    public $observaciones = '';

    protected $rules = [
        'marca' => 'required|string|max:255',
        'modelo' => 'required|string|max:255',
        'numero_serie' => 'required|string|unique:dispositivos,numero_serie',
        'imei' => 'nullable|string|unique:dispositivos,imei|max:50',
        'estado' => 'required|in:disponible,asignado,mantenimiento,baja',
        'fecha_compra' => 'nullable|date',
        'observaciones' => 'nullable|string|max:1000',
    ];

    public function save()
    {
        $this->validate();

        Dispositivo::create([
            'marca' => $this->marca,
            'modelo' => $this->modelo,
            'numero_serie' => $this->numero_serie,
            'imei' => $this->imei,
            'estado' => $this->estado,
            'fecha_compra' => $this->fecha_compra ?: null,
            'observaciones' => $this->observaciones,
        ]);

        session()->flash('message', 'Dispositivo creado correctamente.');
        return redirect()->route('dispositivos.index');
    }

    public function render()
    {
        return view('livewire.dispositivos.create');
    }
}
