<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public function sendVerification(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
            return;
        }

        Auth::user()->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div>
    <div class="mb-4 text-sm text-blue-200">
        <i class="fas fa-envelope mr-1.5"></i>Gracias por registrarte. Antes de comenzar, verifica tu dirección de correo electrónico haciendo clic en el enlace que te enviamos. Si no recibiste el correo, te enviaremos otro con gusto.
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-300">
            <i class="fas fa-check-circle mr-1.5"></i>Se ha enviado un nuevo enlace de verificación a la dirección de correo que proporcionaste durante el registro.
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <button wire:click="sendVerification" class="bg-white text-blue-700 font-bold px-6 py-2.5 rounded-xl hover:bg-blue-50 transition shadow-lg text-sm">
            <i class="fas fa-paper-plane mr-2"></i>Reenviar Correo de Verificación
        </button>

        <button wire:click="logout" type="submit" class="text-sm text-blue-200 hover:text-white underline">
            <i class="fas fa-sign-out-alt mr-1"></i>Cerrar Sesión
        </button>
    </div>
</div>
