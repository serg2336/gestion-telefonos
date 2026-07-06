<div>
    <h1 class="text-2xl font-bold mb-4">Crear Departamento</h1>

    <form wire:submit.prevent="save" class="max-w-md">
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Nombre</label>
            <input type="text" wire:model="nombre" class="border rounded px-4 py-2 w-full">
            @error('nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Descripción</label>
            <textarea wire:model="descripcion" class="border rounded px-4 py-2 w-full" rows="3"></textarea>
            @error('descripcion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Guardar</button>
        <a href="{{ route('departamentos.index') }}" class="ml-2 text-gray-500">Cancelar</a>
    </form>
</div>