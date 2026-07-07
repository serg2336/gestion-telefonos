<div>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Asignaciones</h1>
        @if(auth()->user()->rol === 'admin')
            <a href="{{ route('asignaciones.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition text-sm font-medium shadow-sm">
                <i class="fas fa-plus mr-1.5"></i>Nueva Asignación
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

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
            <input type="text" wire:model.live="search" placeholder="Buscar por empleado o dispositivo..." 
                   class="w-full border rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>
        <div>
            <select wire:model.live="filtro_estado" class="w-full border rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">Todos los estados</option>
                <option value="activo">Activo</option>
                <option value="devuelto">Devuelto</option>
            </select>
        </div>
    </div>

    <div class="relative overflow-x-auto bg-white rounded-lg shadow" wire:loading.class="opacity-50 pointer-events-none">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Empleado</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dispositivo</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Asignación</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Devolución</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($asignaciones as $asignacion)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">{{ $asignacion->empleado->primer_nombre }} {{ $asignacion->empleado->apellido }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">{{ $asignacion->dispositivo->marca }} {{ $asignacion->dispositivo->modelo }} ({{ $asignacion->dispositivo->numero_serie }})</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">{{ $asignacion->fecha_asignacion->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">{{ $asignacion->fecha_devolucion?->format('d/m/Y H:i') ?? '—' }}</td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full {{ $asignacion->estado === 'activo' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-700' }}">
                                {{ ucfirst($asignacion->estado) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-center">
                            @if ($asignacion->estado === 'activo')
                                @if(auth()->user()->rol === 'admin')
                                    <button wire:click="devolver({{ $asignacion->id }})" wire:confirm="¿Devolver este dispositivo?" class="text-yellow-600 hover:text-yellow-800 font-medium" title="Devolver">
                                        <i class="fas fa-undo-alt"></i> Devolver
                                    </button>
                                @else
                                    <span class="text-green-600 text-sm font-medium"><i class="fas fa-check-circle mr-1"></i>Activo</span>
                                @endif
                            @else
                                <span class="text-gray-400 text-sm"><i class="fas fa-check-double mr-1"></i>Devuelto</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-sm text-gray-500">No hay asignaciones registradas.</td>
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
        {{ $asignaciones->links() }}
    </div>
</div>
