<div>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Empleados</h1>
        @if(auth()->user()->rol === 'admin')
            <a href="{{ route('empleados.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition text-sm font-medium shadow-sm">
                <i class="fas fa-plus mr-1.5"></i>Nuevo Empleado
            </a>
        @endif
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 text-sm">
            <i class="fas fa-check-circle mr-1.5"></i>{{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 text-sm">
            <i class="fas fa-exclamation-circle mr-1.5"></i>{{ session('error') }}
        </div>
    @endif

    <div class="mb-4">
        <input type="text" wire:model.live="search" placeholder="Buscar empleados..." 
               class="w-full border rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
    </div>

    <div class="relative overflow-x-auto bg-white rounded-lg shadow" wire:loading.class="opacity-50 pointer-events-none">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teléfono</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Identificación</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Departamento</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($empleados as $empleado)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $empleado->primer_nombre }} {{ $empleado->apellido }}
                            @if ($empleado->pendientes_count > 0)
                                <span class="ml-2 px-2 py-0.5 text-xs font-semibold bg-red-100 text-red-800 rounded-full">
                                    {{ $empleado->pendientes_count }} pendiente(s)
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">{{ $empleado->email }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">{{ $empleado->telefono }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">{{ $empleado->identificacion }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm">
                            <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-700 rounded-full">{{ $empleado->departamento->nombre ?? 'Sin asignar' }}</span>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-center">
                            <a href="{{ route('empleados.show', $empleado->id) }}" class="text-green-600 hover:text-green-800 mx-1" title="Ver">
                                <i class="fas fa-eye"></i>
                            </a>
                            @if(auth()->user()->rol === 'admin')
                                <a href="{{ route('empleados.edit', $empleado->id) }}" class="text-blue-600 hover:text-blue-800 mx-1" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button x-data x-on:click.prevent="$dispatch('open-confirmation-modal', {
                                    action: 'delete',
                                    params: [{{ $empleado->id }}],
                                    title: 'Eliminar empleado',
                                    message: '¿Está seguro de eliminar a {{ $empleado->primer_nombre }} {{ $empleado->apellido }}? Esta acción no se puede deshacer.',
                                    confirmText: 'Eliminar',
                                    confirmClass: 'bg-red-600 hover:bg-red-700'
                                })" class="text-red-600 hover:text-red-800 mx-1" title="Eliminar">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-sm text-gray-500">No hay empleados registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div wire:loading class="absolute inset-0 flex items-center justify-center bg-white/60 rounded-lg">
            <div class="flex items-center gap-2 text-blue-600 font-medium text-sm">
                <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>Cargando...</span>
            </div>
        </div>
    </div>

    <div class="mt-4">
        {{ $empleados->links() }}
    </div>

    <x-confirmation-modal />
</div>
