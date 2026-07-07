<?php

namespace App\Livewire\Dispositivos;

use App\Models\Dispositivo;
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

        $dispositivo = Dispositivo::find($id);
        if ($dispositivo) {
            $dispositivo->delete();
            session()->flash('message', 'Dispositivo eliminado correctamente.');
        }
    }

    public function render()
    {
        $dispositivos = Dispositivo::where('marca', 'like', '%' . $this->search . '%')
            ->orWhere('modelo', 'like', '%' . $this->search . '%')
            ->orWhere('numero_serie', 'like', '%' . $this->search . '%')
            ->orWhere('imei', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.dispositivos.index', compact('dispositivos'));
    }
}
