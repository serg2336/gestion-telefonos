<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    @if ($errors->any())
        <div class="bg-red-500/20 border border-red-400/30 text-red-200 px-4 py-3 rounded-lg mb-4 text-sm backdrop-blur-sm">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <x-auth-session-status class="mb-4 text-sm text-blue-200" :status="session('status')" />

    <form wire:submit="login" class="space-y-4">
        <div>
            <x-input-label for="email" value="Correo Electrónico" class="text-sm font-medium text-blue-100" />
            <x-text-input wire:model="form.email" id="email" 
                          class="block mt-1 w-full bg-white/10 border-white/20 text-white placeholder-blue-200/50 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-400 focus:border-transparent" 
                          type="email" name="email" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2 text-sm text-red-300" />
        </div>

        <div>
            <x-input-label for="password" value="Contraseña" class="text-sm font-medium text-blue-100" />
            <x-text-input wire:model="form.password" id="password" 
                          class="block mt-1 w-full bg-white/10 border-white/20 text-white placeholder-blue-200/50 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-400 focus:border-transparent" 
                          type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('form.password')" class="mt-2 text-sm text-red-300" />
        </div>

        <div class="block mt-4">
            <label for="remember" class="inline-flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox" 
                       class="rounded bg-white/10 border-white/20 text-blue-600 shadow-sm focus:ring-blue-500">
                <span class="ms-2 text-sm text-blue-200">Recordarme</span>
            </label>
        </div>

        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 mt-4">
            @if (Route::has('password.request'))
                <a class="text-sm text-blue-200 hover:text-white underline rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" href="{{ route('password.request') }}" wire:navigate>
                    ¿Olvidaste tu contraseña?
                </a>
            @endif

            <button type="submit" class="w-full sm:w-auto bg-white text-blue-700 font-bold px-6 py-2.5 rounded-xl hover:bg-blue-50 transition shadow-lg">
                <i class="fas fa-sign-in-alt mr-2"></i>Iniciar sesión
            </button>
        </div>

        <div class="mt-4 text-center text-sm text-blue-200/70">
            ¿Necesitas acceso? Contacta al administrador del sistema.
        </div>
    </form>
</div>
