<div class="py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-4">Crear Nuevo Empleado</h1>

        <form wire:submit.prevent="save">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Primer Nombre -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Primer Nombre</label>
                    <input type="text" wire:model="primer_nombre" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('primer_nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Apellido -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Apellido</label>
                    <input type="text" wire:model="apellido" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('apellido') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" wire:model="email" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Teléfono -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                    <input type="text" wire:model="telefono" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('telefono') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Identificación -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Identificación</label>
                    <input type="text" wire:model="identificacion" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('identificacion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Departamento (opcional, si quieres mostrarlo) -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Departamento</label>
                    <select wire:model="departamento_id" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Sin departamento</option>
                        @foreach(\App\Models\Departamento::all() as $departamento)
                            <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                        @endforeach
                    </select>
                    @error('departamento_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Botones -->
            <div class="flex justify-end items-center gap-4 mt-8 border-t pt-6">
                <a href="{{ route('empleados.index') }}" class="text-gray-600 hover:text-gray-800 transition">Cancelar</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition">
                    Guardar Empleado
                </button>
            </div>
        </form>
    </div>
</div>