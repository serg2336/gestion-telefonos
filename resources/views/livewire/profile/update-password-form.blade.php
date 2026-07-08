<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component
{
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');
            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Actualizar Contraseña
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Asegúrate de que tu cuenta use una contraseña larga y aleatoria para mantenerse segura.
        </p>
    </header>

    <form wire:submit="updatePassword" class="mt-6 space-y-6">
        <div>
            <x-input-label for="update_password_current_password" :value="__('Contraseña Actual')" />
            <x-text-input wire:model="current_password" id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('Nueva Contraseña')" />
            <x-text-input wire:model.live="password" id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            <div class="mt-2 space-y-1 text-sm">
                <div :class="$wire.password.length >= 8 ? 'text-green-600' : 'text-red-500'" x-data>
                    <span x-text="$wire.password.length >= 8 ? '✓' : '✗'"></span>
                    Mínimo 8 caracteres
                </div>
                <div :class="/[A-Z]/.test($wire.password) ? 'text-green-600' : 'text-red-500'" x-data>
                    <span x-text="/[A-Z]/.test($wire.password) ? '✓' : '✗'"></span>
                    Al menos 1 mayúscula
                </div>
                <div :class="/[^a-zA-Z0-9\u00f1\u00d1]/.test($wire.password) ? 'text-green-600' : 'text-red-500'" x-data>
                    <span x-text="/[^a-zA-Z0-9\u00f1\u00d1]/.test($wire.password) ? '✓' : '✗'"></span>
                    Al menos 1 símbolo
                </div>
            </div>
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirmar Contraseña')" />
            <x-text-input wire:model="password_confirmation" id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>Guardar</x-primary-button>

            <x-action-message class="me-3" on="password-updated">
                Guardado.
            </x-action-message>
        </div>
    </form>
</section>
