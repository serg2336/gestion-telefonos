<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="bg-white p-6 rounded shadow-md w-96">
            <h1 class="text-2xl font-bold mb-4">Registrarse</h1>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-4">
                    <label class="block">Nombre</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded px-3 py-2">
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded px-3 py-2">
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block">Contraseña</label>
                    <input type="password" name="password" class="w-full border rounded px-3 py-2">
                    @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block">Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2">
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded">Registrarse</button>
            </form>
        </div>
    </div>
</body>
</html>