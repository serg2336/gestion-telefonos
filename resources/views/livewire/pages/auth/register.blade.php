<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $rol = 'usuario';

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'rol' => ['required', 'in:usuario,admin'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <form wire:submit="register">
        <!-- Nombre -->
        <div>
            <x-input-label for="name" value="Nombre" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full bg-white/10 border-white/20 text-white placeholder-blue-200/50 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-400 focus:border-transparent" type="text" name="name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-300" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" value="Correo Electrónico" class="text-sm font-medium text-blue-100" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full bg-white/10 border-white/20 text-white placeholder-blue-200/50 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-400 focus:border-transparent" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-300" />
        </div>

        <!-- Contraseña -->
        <div class="mt-4">
            <x-input-label for="password" value="Contraseña" class="text-sm font-medium text-blue-100" />
            <x-text-input wire:model="password" id="password" class="block mt-1 w-full bg-white/10 border-white/20 text-white placeholder-blue-200/50 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-400 focus:border-transparent" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-300" />
        </div>

        <!-- Confirmar Contraseña -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Confirmar Contraseña" class="text-sm font-medium text-blue-100" />
            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full bg-white/10 border-white/20 text-white placeholder-blue-200/50 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-400 focus:border-transparent" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-300" />
        </div>

        <!-- Campo Rol (solo visible para administradores) -->
        @if(auth()->check() && auth()->user()->rol === 'admin')
        <div class="mt-4">
            <x-input-label for="rol" value="Rol" class="text-sm font-medium text-blue-100" />
            <select wire:model="rol" id="rol" class="block mt-1 w-full bg-white/10 border-white/20 text-white rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                <option value="usuario" class="text-gray-900">Usuario</option>
                <option value="admin" class="text-gray-900">Administrador</option>
            </select>
            <x-input-error :messages="$errors->get('rol')" class="mt-2 text-sm text-red-300" />
        </div>
        @endif

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-blue-200 hover:text-white rounded-md" href="{{ route('login') }}" wire:navigate>
                ¿Ya estás registrado?
            </a>

            <button type="submit" class="ms-4 bg-white text-blue-700 font-bold px-6 py-2.5 rounded-xl hover:bg-blue-50 transition shadow-lg text-sm">
                <i class="fas fa-user-plus mr-2"></i>Registrarse
            </button>
        </div>
    </form>
</div>
