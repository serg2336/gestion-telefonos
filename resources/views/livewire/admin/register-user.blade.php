<div>
    <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-6">Registrar Nuevo Usuario</h1>

        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit.prevent="register" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" wire:model="name" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" wire:model="email" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input type="password" wire:model="password" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Confirmar Contraseña</label>
                <input type="password" wire:model="password_confirmation" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                @error('password_confirmation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Rol</label>
                <select wire:model="rol" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="usuario">Usuario</option>
                    <option value="admin">Administrador</option>
                </select>
                @error('rol') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition">
                Registrar Usuario
            </button>
        </form>
    </div>
</div>