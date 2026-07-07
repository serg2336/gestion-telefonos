<div class="py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center gap-4 mb-6 border-b pb-4">
            <a href="{{ route('departamentos.index') }}" class="text-gray-500 hover:text-gray-700" title="Volver">
                <i class="fas fa-arrow-left text-lg"></i>
            </a>
            <h1 class="text-xl font-bold text-gray-800">
                <i class="fas fa-building mr-2 text-blue-600"></i>Crear Departamento
            </h1>
        </div>

        <form wire:submit.prevent="save">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                    <input type="text" wire:model="nombre" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                    <textarea wire:model="descripcion" rows="3" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Descripción del departamento..."></textarea>
                    @error('descripcion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex justify-end items-center gap-4 mt-8 border-t pt-6">
                <a href="{{ route('departamentos.index') }}" class="text-gray-600 hover:text-gray-800 transition text-sm">Cancelar</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition text-sm">
                    <i class="fas fa-save mr-1.5"></i>Guardar Departamento
                </button>
            </div>
        </form>
    </div>
</div>
