<div>
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-4">
        <h1 class="text-xl sm:text-2xl font-bold">Departamentos</h1>
        @if(auth()->user()->rol === 'admin')
            <a href="{{ route('departamentos.create') }}" class="w-full sm:w-auto bg-blue-500 text-white px-4 py-2 rounded text-center hover:bg-blue-600 transition">
                Nuevo Departamento
            </a>
        @endif
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-sm">
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-4">
        <input type="text" wire:model.live="search" placeholder="Buscar departamentos..." 
               class="w-full border rounded px-4 py-2 text-sm sm:text-base focus:ring-2 focus:ring-blue-500 focus:border-transparent">
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Descripción</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($departamentos as $departamento)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-3 py-2 whitespace-nowrap text-sm">{{ $departamento->nombre }}</td>
                        <td class="px-3 py-2 whitespace-nowrap text-sm hidden sm:table-cell">{{ $departamento->descripcion ?? 'Sin descripción' }}</td>
                        <td class="px-3 py-2 whitespace-nowrap text-sm">
                            @if(auth()->user()->rol === 'admin')
                                <a href="{{ route('departamentos.edit', $departamento->id) }}" class="text-blue-600 hover:text-blue-800">Editar</a>
                                <button wire:click="delete({{ $departamento->id }})" wire:confirm="¿Eliminar este departamento?" class="text-red-600 hover:text-red-800 ml-2">Eliminar</button>
                            @else
                                <span class="text-gray-400 text-sm">Sin permisos</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $departamentos->links() }}
    </div>
</div>