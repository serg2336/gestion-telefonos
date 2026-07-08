<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>INNOVATECH - Sistema de Gestión</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans">
        <div class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-blue-600 to-indigo-800">
            
            <div class="relative w-full max-w-2xl px-6 flex flex-col items-center justify-center min-h-screen">
                
                <div class="mb-8 text-center">
                    <span class="text-5xl font-bold text-white tracking-wider drop-shadow-lg">INNOVATECH</span>
                    <p class="text-blue-200 mt-2 text-lg">Sistema de Gestión de Dispositivos</p>
                </div>

                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 shadow-2xl border border-white/20 w-full max-w-md">
                    <div class="text-center mb-6">
                        <i class="fas fa-laptop-house text-white text-5xl mb-4"></i>
                        <h2 class="text-xl font-semibold text-white">Bienvenido</h2>
                        <p class="text-blue-200 text-sm mt-1">Accedé al panel de administración</p>
                    </div>

                    <div class="flex justify-center">
                        @auth
                            <a href="{{ url('/dashboard') }}" 
                               class="w-full text-center bg-white text-blue-700 font-bold py-3 px-6 rounded-xl hover:bg-blue-50 transition transform hover:scale-105 shadow-lg">
                                <i class="fas fa-tachometer-alt mr-2"></i>Ir al Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" 
                               class="w-full text-center bg-white text-blue-700 font-bold py-3 px-6 rounded-xl hover:bg-blue-50 transition transform hover:scale-105 shadow-lg">
                                <i class="fas fa-sign-in-alt mr-2"></i>Iniciar Sesión
                            </a>
                        @endauth
                    </div>
                </div>

                <footer class="py-8 text-center text-sm text-blue-200/70">
                    &copy; {{ date('Y') }} INNOVATECH - Todos los derechos reservados.
                </footer>
            </div>
        </div>
    </body>
</html>
