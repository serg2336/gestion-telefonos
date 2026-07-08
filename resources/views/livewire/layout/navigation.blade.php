<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo + Nav Links -->
            <div class="flex items-center">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate>
                        <span class="text-2xl font-bold text-blue-600 tracking-wider">INNOVATECH</span>
                    </a>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ms-10 space-x-1">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                        <i class="fas fa-chart-pie mr-1.5"></i>Panel
                    </x-nav-link>

                    @if(auth()->user()->rol === 'admin')
                        <x-nav-link :href="route('empleados.index')" :active="request()->routeIs('empleados.*')" wire:navigate>
                            <i class="fas fa-users mr-1.5"></i>Empleados
                        </x-nav-link>

                        <x-nav-link :href="route('dispositivos.index')" :active="request()->routeIs('dispositivos.*')" wire:navigate>
                            <i class="fas fa-tablet-alt mr-1.5"></i>Dispositivos
                        </x-nav-link>

                        <x-nav-link :href="route('asignaciones.index')" :active="request()->routeIs('asignaciones.*')" wire:navigate>
                            <i class="fas fa-exchange-alt mr-1.5"></i>Asignaciones
                        </x-nav-link>

                        <x-nav-link :href="route('departamentos.index')" :active="request()->routeIs('departamentos.*')" wire:navigate>
                            <i class="fas fa-building mr-1.5"></i>Departamentos
                        </x-nav-link>

                        <x-nav-link :href="route('admin.register-user')" :active="request()->routeIs('admin.register-user')" wire:navigate>
                            <i class="fas fa-user-plus mr-1.5"></i>Registrar
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('mi-dispositivo')" :active="request()->routeIs('mi-dispositivo')" wire:navigate>
                            <i class="fas fa-mobile-alt mr-1.5"></i>Mi Dispositivo
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-600 bg-white hover:text-gray-800 hover:bg-gray-50 focus:outline-none transition ease-in-out duration-150">
                            <i class="fas fa-user-circle mr-2 text-lg"></i>
                            <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile')" wire:navigate>
                            <i class="fas fa-id-card mr-2"></i>Mi Perfil
                        </x-dropdown-link>

                        @if(auth()->user()->rol === 'admin')
                            <x-dropdown-link :href="route('usuarios.index')" wire:navigate>
                                <i class="fas fa-users-cog mr-2"></i>Usuarios
                            </x-dropdown-link>
                        @endif

                        <div class="border-t border-gray-200"></div>

                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link>
                                <i class="fas fa-sign-out-alt mr-2"></i>Cerrar Sesión
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1 border-b border-gray-200">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                <i class="fas fa-chart-pie mr-2 w-5 text-center"></i>Panel
            </x-responsive-nav-link>

            @if(auth()->user()->rol === 'admin')
                <x-responsive-nav-link :href="route('empleados.index')" :active="request()->routeIs('empleados.*')" wire:navigate>
                    <i class="fas fa-users mr-2 w-5 text-center"></i>Empleados
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('dispositivos.index')" :active="request()->routeIs('dispositivos.*')" wire:navigate>
                    <i class="fas fa-tablet-alt mr-2 w-5 text-center"></i>Dispositivos
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('asignaciones.index')" :active="request()->routeIs('asignaciones.*')" wire:navigate>
                    <i class="fas fa-exchange-alt mr-2 w-5 text-center"></i>Asignaciones
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('departamentos.index')" :active="request()->routeIs('departamentos.*')" wire:navigate>
                    <i class="fas fa-building mr-2 w-5 text-center"></i>Departamentos
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.register-user')" :active="request()->routeIs('admin.register-user')" wire:navigate>
                    <i class="fas fa-user-plus mr-2 w-5 text-center"></i>Registrar Usuario
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('usuarios.index')" :active="request()->routeIs('usuarios.*')" wire:navigate>
                    <i class="fas fa-users-cog mr-2 w-5 text-center"></i>Usuarios
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('mi-dispositivo')" :active="request()->routeIs('mi-dispositivo')" wire:navigate>
                    <i class="fas fa-mobile-alt mr-2 w-5 text-center"></i>Mi Dispositivo
                </x-responsive-nav-link>
            @endif
        </div>

        <div class="pt-3 pb-4 space-y-1">
            <div class="px-4 mb-3">
                <div class="font-medium text-base text-gray-800" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
            </div>

            <x-responsive-nav-link :href="route('profile')" wire:navigate>
                <i class="fas fa-id-card mr-2 w-5 text-center"></i>Mi Perfil
            </x-responsive-nav-link>

            <button wire:click="logout" class="w-full text-start">
                <x-responsive-nav-link>
                    <i class="fas fa-sign-out-alt mr-2 w-5 text-center"></i>Cerrar Sesión
                </x-responsive-nav-link>
            </button>
        </div>
    </div>
</nav>
