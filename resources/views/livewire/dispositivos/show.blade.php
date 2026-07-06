<div class="py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">{{ $dispositivo->marca }} {{ $dispositivo->modelo }}</h1>
            <a href="{{ route('empleados.index') }}" class="text-gray-600 hover:text-gray-800 px-4 py-2">Volver</a>
        </div>

        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4 border-b pb-2">Información del Dispositivo</h2>
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm text-gray-500">Marca</dt>
                    <dd class="font-medium">{{ $dispositivo->marca }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">Modelo</dt>
                    <dd class="font-medium">{{ $dispositivo->modelo }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">Número de Serie</dt>
                    <dd class="font-medium">{{ $dispositivo->numero_serie }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">IMEI</dt>
                    <dd class="font-medium">{{ $dispositivo->imei ?? '—' }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">Estado</dt>
                    <dd class="font-medium">
                        <span class="px-2 py-1 text-xs font-semibold rounded {{ $dispositivo->estado === 'disponible' ? 'bg-green-100 text-green-700' : ($dispositivo->estado === 'asignado' ? 'bg-blue-100 text-blue-700' : ($dispositivo->estado === 'mantenimiento' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700')) }}">
                            {{ ucfirst($dispositivo->estado) }}
                        </span>
                    </dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">Fecha de Compra</dt>
                    <dd class="font-medium">{{ $dispositivo->fecha_compra?->format('d/m/Y') ?? '—' }}</dd>
                </div>
                <div class="md:col-span-2">
                    <dt class="text-sm text-gray-500">Observaciones</dt>
                    <dd class="font-medium">{{ $dispositivo->observaciones ?? '—' }}</dd>
                </div>
            </dl>
        </div>

        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4 border-b pb-2">Historial de Asignaciones</h2>

            @if ($dispositivo->asignaciones->isEmpty())
                <p class="text-gray-500 text-center py-4">Este dispositivo no tiene asignaciones registradas.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 text-left">Empleado</th>
                                <th class="px-4 py-2 text-left">Fecha Asignación</th>
                                <th class="px-4 py-2 text-left">Fecha Devolución</th>
                                <th class="px-4 py-2 text-left">Estado</th>
                                <th class="px-4 py-2 text-left">Observaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dispositivo->asignaciones as $asignacion)
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $asignacion->empleado->primer_nombre }} {{ $asignacion->empleado->apellido }}</td>
                                    <td class="px-4 py-2">{{ $asignacion->fecha_asignacion->format('d/m/Y H:i') }}</td>
                                    <td class="px-4 py-2">{{ $asignacion->fecha_devolucion?->format('d/m/Y H:i') ?? '—' }}</td>
                                    <td class="px-4 py-2">
                                        <span class="px-2 py-1 text-xs font-semibold rounded {{ $asignacion->estado === 'activo' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                            {{ ucfirst($asignacion->estado) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2">{{ $asignacion->observaciones ?? '—' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
