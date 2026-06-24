<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-4">Panel de Control</h1>
                    <p>Bienvenido, {{ Auth::user()->name }}!</p>

                    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ route('empleados.index') }}" class="bg-blue-500 text-white px-4 py-3 rounded text-center hover:bg-blue-600">
                            Gestionar Empleados
                        </a>
                        <a href="{{ route('empleados.create') }}" class="bg-green-500 text-white px-4 py-3 rounded text-center hover:bg-green-600">
                            Crear Empleado
                        </a>
                        <!-- Más enlaces para dispositivos y asignaciones -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>