<?php

namespace App\Livewire\Usuarios;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $users;
    public $selectedRoles = [];

    public function mount()
    {
        $this->users = User::all();
        foreach ($this->users as $user) {
            $this->selectedRoles[$user->id] = $user->rol;
        }
    }

    public function updateRole($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->rol = $this->selectedRoles[$userId];
            $user->save();
            session()->flash('message', 'Rol actualizado correctamente.');
        }
    }

    public function render()
    {
        return view('livewire.usuarios.index');
    }
}