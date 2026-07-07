<div class="py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center gap-4 mb-6 border-b pb-4">
            <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-700" title="Volver">
                <i class="fas fa-arrow-left text-lg"></i>
            </a>
            <h1 class="text-xl font-bold text-gray-800">
                <i class="fas fa-user-plus mr-2 text-blue-600"></i>Registrar Nuevo Usuario
            </h1>
        </div>

        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 text-sm">
                <i class="fas fa-check-circle mr-1.5"></i>{{ session('message') }}
            </div>
        @endif

        <form wire:submit.prevent="register" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                    <input type="text" wire:model="name" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" wire:model="email" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                    <input type="password" wire:model="password" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Confirmar Contraseña</label>
                    <input type="password" wire:model="password_confirmation" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('password_confirmation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Rol</label>
                <select wire:model="rol" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="usuario">Usuario</option>
                    <option value="admin">Administrador</option>
                </select>
                @error('rol') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end items-center gap-4 mt-6 border-t pt-6">
                <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-800 transition text-sm">Cancelar</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition text-sm">
                    <i class="fas fa-user-check mr-1.5"></i>Registrar Usuario
                </button>
            </div>
        </form>
    </div>
</div>
