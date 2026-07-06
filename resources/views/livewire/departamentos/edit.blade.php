<div>
    <h1 class="text-2xl font-bold mb-4">Editar Departamento</h1>

    <form wire:submit.prevent="update" class="max-w-md">
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

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Actualizar</button>
        <a href="{{ route('departamentos.index') }}" class="ml-2 text-gray-500">Cancelar</a>
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
    </form>
</div>