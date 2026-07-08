<?php

namespace App\Livewire\Dispositivos;

use App\Models\Dispositivo;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Edit extends Component
{
    public $dispositivo_id;
    public $marca;
    public $modelo;
    public $numero_serie;
    public $imei;
    public $estado;
    public $fecha_compra;
    public $observaciones;

    public function mount($id)
    {
        $dispositivo = Dispositivo::findOrFail($id);
        $this->dispositivo_id = $dispositivo->id;
        $this->marca = $dispositivo->marca;
        $this->modelo = $dispositivo->modelo;
        $this->numero_serie = $dispositivo->numero_serie;
        $this->imei = $dispositivo->imei;
        $this->estado = $dispositivo->estado;
        $this->fecha_compra = $dispositivo->fecha_compra?->format('Y-m-d');
        $this->observaciones = $dispositivo->observaciones;
    }

    public function update()
    {
        $this->validate([
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'numero_serie' => 'required|string|unique:dispositivos,numero_serie,' . $this->dispositivo_id,
            'imei' => 'nullable|string|unique:dispositivos,imei,' . $this->dispositivo_id . '|max:50',
            'estado' => 'required|in:disponible,asignado,mantenimiento,baja,bloqueado',
            'fecha_compra' => 'nullable|date',
            'observaciones' => 'nullable|string|max:1000',
        ]);

        Dispositivo::find($this->dispositivo_id)->update([
            'marca' => $this->marca,
            'modelo' => $this->modelo,
            'numero_serie' => $this->numero_serie,
            'imei' => $this->imei,
            'estado' => $this->estado,
            'fecha_compra' => $this->fecha_compra ?: null,
            'observaciones' => $this->observaciones,
        ]);

        session()->flash('message', 'Dispositivo actualizado correctamente.');
        return redirect()->route('dispositivos.index');
    }

    public function render()
    {
        return view('livewire.dispositivos.edit');
    }
}
