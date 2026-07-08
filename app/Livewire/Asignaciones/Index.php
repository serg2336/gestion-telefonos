<?php

namespace App\Livewire\Asignaciones;

use App\Models\Asignacion;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $filtro_estado = '';

    public function devolver($id)
    {
        if (auth()->user()->rol !== 'admin') {
            abort(403);
        }

        $asignacion = Asignacion::with('dispositivo')->findOrFail($id);

        if ($asignacion->estado !== 'activo') {
            session()->flash('error', 'Esta asignación ya fue devuelta.');
            return;
        }

        $asignacion->update([
            'estado' => 'devuelto',
            'fecha_devolucion' => now(),
        ]);

        $asignacion->dispositivo->update(['estado' => 'disponible']);
        $asignacion->dispositivo->save();

        session()->flash('message', 'Dispositivo devuelto correctamente.');
    }

    public function render()
    {
        $query = Asignacion::with(['empleado', 'dispositivo']);

        if ($this->search) {
            $query->where(function ($q) {
                $q->whereHas('empleado', function ($q) {
                    $q->where('primer_nombre', 'like', '%' . $this->search . '%')
                      ->orWhere('apellido', 'like', '%' . $this->search . '%');
                })->orWhereHas('dispositivo', function ($q) {
                    $q->where('marca', 'like', '%' . $this->search . '%')
                      ->orWhere('modelo', 'like', '%' . $this->search . '%')
                      ->orWhere('numero_serie', 'like', '%' . $this->search . '%');
                });
            });
        }

        if ($this->filtro_estado) {
            $query->where('estado', $this->filtro_estado);
        }

        $asignaciones = $query->latest('fecha_asignacion')->paginate(10);

        return view('livewire.asignaciones.index', compact('asignaciones'));
    }
}
