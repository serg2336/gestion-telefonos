<?php

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    #[Locked]
    public string $token = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function mount(string $token): void
    {
        $this->token = $token;
        $this->email = request()->string('email');
    }

    public function resetPassword(): void
    {
        $this->validate([
            'token' => ['required'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $status = Password::reset(
            $this->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) {
                $user->forceFill([
                    'password' => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status != Password::PASSWORD_RESET) {
            $this->addError('email', __($status));
            return;
        }

        Session::flash('status', __($status));
        $this->redirectRoute('login', navigate: true);
    }
}; ?>

<div>
    <form wire:submit="resetPassword">
        <div>
            <x-input-label for="email" value="Correo Electrónico" class="text-sm font-medium text-blue-100" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full bg-white/10 border-white/20 text-white placeholder-blue-200/50 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-400 focus:border-transparent" type="email" name="email" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-300" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Nueva Contraseña" class="text-sm font-medium text-blue-100" />
            <x-text-input wire:model="password" id="password" class="block mt-1 w-full bg-white/10 border-white/20 text-white placeholder-blue-200/50 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-400 focus:border-transparent" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-300" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Confirmar Contraseña" class="text-sm font-medium text-blue-100" />
            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full bg-white/10 border-white/20 text-white placeholder-blue-200/50 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-400 focus:border-transparent" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-300" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="bg-white text-blue-700 font-bold px-6 py-2.5 rounded-xl hover:bg-blue-50 transition shadow-lg text-sm">
                <i class="fas fa-key mr-2"></i>Restablecer Contraseña
            </button>
        </div>
    </form>
</div>
