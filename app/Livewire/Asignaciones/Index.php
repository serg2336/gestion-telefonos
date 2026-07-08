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

    public function marcarPendiente($id)
    {
        if (auth()->user()->rol !== 'admin') {
            abort(403);
        }

        $asignacion = Asignacion::with('dispositivo')->findOrFail($id);

        if ($asignacion->estado !== 'activo') {
            session()->flash('error', 'Solo se pueden marcar como pendientes las asignaciones activas.');
            return;
        }

        $asignacion->update(['estado' => 'pendiente_devolver']);
        $asignacion->dispositivo->update(['estado' => 'bloqueado']);

        session()->flash('message', 'Dispositivo marcado como pendiente de devolver. El IMEI ha sido bloqueado.');
    }

    public function quitarPendiente($id)
    {
        if (auth()->user()->rol !== 'admin') {
            abort(403);
        }

        $asignacion = Asignacion::with('dispositivo')->findOrFail($id);

        if ($asignacion->estado !== 'pendiente_devolver') {
            session()->flash('error', 'Esta asignación no está marcada como pendiente.');
            return;
        }

        $asignacion->update(['estado' => 'activo']);
        $asignacion->dispositivo->update(['estado' => 'asignado']);

        session()->flash('message', 'Dispositivo reactivado. El IMEI ya no está bloqueado.');
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
                      ->orWhere('numero_serie', 'like', '%' . $this->search . '%')
                      ->orWhere('imei', 'like', '%' . $this->search . '%');
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
