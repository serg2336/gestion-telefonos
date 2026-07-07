<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $email = '';

    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));
            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>

<div>
    <div class="mb-4 text-sm text-blue-200">
        <i class="fas fa-info-circle mr-1.5"></i>¿Olvidaste tu contraseña? No hay problema. Solo indícanos tu correo electrónico y te enviaremos un enlace para restablecerla.
    </div>

    <x-auth-session-status class="mb-4 text-sm text-blue-200" :status="session('status')" />

    <form wire:submit="sendPasswordResetLink">
        <div>
            <x-input-label for="email" value="Correo Electrónico" class="text-sm font-medium text-blue-100" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full bg-white/10 border-white/20 text-white placeholder-blue-200/50 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-400 focus:border-transparent" type="email" name="email" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-300" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="bg-white text-blue-700 font-bold px-6 py-2.5 rounded-xl hover:bg-blue-50 transition shadow-lg text-sm">
                <i class="fas fa-paper-plane mr-2"></i>Enviar Enlace
            </button>
        </div>

        <div class="mt-4 text-center">
            <a href="{{ route('login') }}" class="text-sm text-blue-200 hover:text-white underline" wire:navigate>
                <i class="fas fa-arrow-left mr-1"></i>Volver al inicio de sesión
            </a>
        </div>
    </form>
</div>
