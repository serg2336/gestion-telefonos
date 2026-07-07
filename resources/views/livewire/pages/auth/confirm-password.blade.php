<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $password = '';

    public function confirmPassword(): void
    {
        $this->validate([
            'password' => ['required', 'string'],
        ]);

        if (! Auth::guard('web')->validate([
            'email' => Auth::user()->email,
            'password' => $this->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        session(['auth.password_confirmed_at' => time()]);

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <div class="mb-4 text-sm text-blue-200">
        <i class="fas fa-shield-alt mr-1.5"></i>Esta es un área segura de la aplicación. Confirma tu contraseña antes de continuar.
    </div>

    <form wire:submit="confirmPassword">
        <div>
            <x-input-label for="password" value="Contraseña" class="text-sm font-medium text-blue-100" />
            <x-text-input wire:model="password"
                          id="password"
                          class="block mt-1 w-full bg-white/10 border-white/20 text-white placeholder-blue-200/50 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                          type="password"
                          name="password"
                          required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-300" />
        </div>

        <div class="flex justify-end mt-4">
            <button type="submit" class="bg-white text-blue-700 font-bold px-6 py-2.5 rounded-xl hover:bg-blue-50 transition shadow-lg text-sm">
                <i class="fas fa-check mr-2"></i>Confirmar
            </button>
        </div>
    </form>
</div>
