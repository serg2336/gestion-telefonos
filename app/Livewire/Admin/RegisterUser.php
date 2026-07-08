<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]

class RegisterUser extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $rol = 'usuario';

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'string', 'confirmed', Password::min(8)->mixedCase()->symbols()],
            'rol' => 'required|in:usuario,admin',
        ];
    }

    public function register()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'rol' => $this->rol,
        ]);

        session()->flash('message', 'Usuario creado exitosamente.');
        $this->reset(['name', 'email', 'password', 'password_confirmation']);
    }

    public function render()
    {
        return view('livewire.admin.register-user');
    }
}
