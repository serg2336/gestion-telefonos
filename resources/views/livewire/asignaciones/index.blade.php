<div>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Asignaciones</h1>
        <a href="{{ route('asignaciones.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Nueva Asignación</a>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
            <input type="text" wire:model.live="search" placeholder="Buscar por empleado o dispositivo..." class="border rounded px-4 py-2 w-full">
        </div>
        <div>
            <select wire:model.live="filtro_estado" class="border rounded px-4 py-2 w-full">
                <option value="">Todos los estados</option>
                <option value="activo">Activo</option>
                <option value="devuelto">Devuelto</option>
            </select>
        </div>
    </div>

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left">Empleado</th>
                    <th class="px-4 py-2 text-left">Dispositivo</th>
                    <th class="px-4 py-2 text-left">Fecha Asignación</th>
                    <th class="px-4 py-2 text-left">Fecha Devolución</th>
                    <th class="px-4 py-2 text-left">Estado</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($asignaciones as $asignacion)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $asignacion->empleado->primer_nombre }} {{ $asignacion->empleado->apellido }}</td>
                        <td class="px-4 py-2">{{ $asignacion->dispositivo->marca }} {{ $asignacion->dispositivo->modelo }} ({{ $asignacion->dispositivo->numero_serie }})</td>
                        <td class="px-4 py-2">{{ $asignacion->fecha_asignacion->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-2">{{ $asignacion->fecha_devolucion?->format('d/m/Y H:i') ?? '—' }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 text-xs font-semibold rounded {{ $asignacion->estado === 'activo' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                {{ ucfirst($asignacion->estado) }}
                            </span>
                        </td>
                        <td class="px-4 py-2 text-center">
                            @if ($asignacion->estado === 'activo')
                                <button wire:click="devolver({{ $asignacion->id }})" wire:confirm="¿Devolver este dispositivo?" class="text-yellow-500 hover:underline">Devolver</button>
                            @else
                                <span class="text-gray-400">Devuelto</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-gray-500">No hay asignaciones registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $asignaciones->links() }}
    </div>
</div>
