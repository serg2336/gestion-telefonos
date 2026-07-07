<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
    {{-- Agregado py-4 (medio centímetro más o menos) para margen vertical --}}
    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4 sm:px-6 py-4">
        <div class="w-full sm:max-w-md mx-auto">
            <div class="bg-white p-6 sm:p-8 rounded-lg shadow-md">
                {{-- Encabezado con botón de volver a la izquierda y título centrado --}}
                <div class="flex items-center justify-between mb-6">
                    <a href="{{ route('dashboard') }}" 
                       class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 hover:bg-gray-100 px-3 py-1 rounded-md transition duration-200">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Volver
                    </a>
                    <h1 class="text-2xl font-bold text-gray-800">Registrarse</h1>
                    <span class="w-16"></span> {{-- Espaciador para equilibrar --}}
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Nombre -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                        <input type="text" name="name" value="{{ old('name') }}" 
                               class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('name') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" 
                               class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('email') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Contraseña -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                        <input type="password" name="password" 
                               class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('password') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Confirmar Contraseña -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" 
                               class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <!-- Rol -->
                    <div class="mb-4">
                        <x-input-label for="rol" :value="__('Rol')" />
                        <select name="rol" id="rol" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                            <option value="usuario">Usuario</option>
                            <option value="admin">Administrador</option>
                        </select>
                        <x-input-error :messages="$errors->get('rol')" class="mt-2" />
                    </div>

                    <!-- Botón Registrarse -->
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition duration-200">
                        Registrarse
                    </button>
                </form>

                <!-- Enlace a login -->
                <div class="mt-6 text-center text-sm text-gray-600">
                    ¿Ya tienes cuenta?
                    <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Inicia sesión</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>