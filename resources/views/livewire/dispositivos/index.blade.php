<div>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Dispositivos</h1>
        <a href="{{ route('dispositivos.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Nuevo Dispositivo</a>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-4">
        <input type="text" wire:model.live="search" placeholder="Buscar por marca, modelo, serie o IMEI..." class="border rounded px-4 py-2 w-full">
    </div>

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left">Marca</th>
                    <th class="px-4 py-2 text-left">Modelo</th>
                    <th class="px-4 py-2 text-left">Número de Serie</th>
                    <th class="px-4 py-2 text-left">IMEI</th>
                    <th class="px-4 py-2 text-left">Estado</th>
                    <th class="px-4 py-2 text-left">Fecha Compra</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dispositivos as $dispositivo)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $dispositivo->marca }}</td>
                        <td class="px-4 py-2">{{ $dispositivo->modelo }}</td>
                        <td class="px-4 py-2">{{ $dispositivo->numero_serie }}</td>
                        <td class="px-4 py-2">{{ $dispositivo->imei ?? '—' }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 text-xs font-semibold rounded {{ $dispositivo->estado === 'disponible' ? 'bg-green-100 text-green-700' : ($dispositivo->estado === 'asignado' ? 'bg-blue-100 text-blue-700' : ($dispositivo->estado === 'mantenimiento' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700')) }}">
                                {{ ucfirst($dispositivo->estado) }}
                            </span>
                        </td>
                        <td class="px-4 py-2">{{ $dispositivo->fecha_compra?->format('d/m/Y') ?? '—' }}</td>
                        <td class="px-4 py-2 text-center">
                            <a href="{{ route('dispositivos.show', $dispositivo->id) }}" class="text-green-500 hover:underline">Ver</a>
                            <a href="{{ route('dispositivos.edit', $dispositivo->id) }}" class="text-blue-500 hover:underline ml-2">Editar</a>
                            <button wire:click="delete({{ $dispositivo->id }})" wire:confirm="¿Eliminar este dispositivo?" class="text-red-500 hover:underline ml-2">Eliminar</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-gray-500">No hay dispositivos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $dispositivos->links() }}
    </div>
</div>
