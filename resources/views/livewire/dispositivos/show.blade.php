<div class="py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div class="flex items-center gap-3">
                <a href="{{ route('dispositivos.index') }}" class="text-gray-500 hover:text-gray-700" title="Volver">
                    <i class="fas fa-arrow-left text-lg"></i>
                </a>
                <h1 class="text-2xl font-bold text-gray-800">{{ $dispositivo->marca }} {{ $dispositivo->modelo }}</h1>
            </div>
            @if(auth()->user()->rol === 'admin')
                <a href="{{ route('dispositivos.edit', $dispositivo->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition text-sm font-medium shadow-sm">
                    <i class="fas fa-edit mr-1.5"></i>Editar
                </a>
            @endif
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-700 mb-4 border-b pb-2">
                <i class="fas fa-info-circle mr-2 text-blue-500"></i>Información del Dispositivo
            </h2>
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-gray-50 rounded-lg p-3">
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Marca</dt>
                    <dd class="font-medium text-gray-900 mt-1">{{ $dispositivo->marca }}</dd>
                </div>
                <div class="bg-gray-50 rounded-lg p-3">
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Modelo</dt>
                    <dd class="font-medium text-gray-900 mt-1">{{ $dispositivo->modelo }}</dd>
                </div>
                <div class="bg-gray-50 rounded-lg p-3">
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Número de Serie</dt>
                    <dd class="font-medium text-gray-900 mt-1">{{ $dispositivo->numero_serie }}</dd>
                </div>
                <div class="bg-gray-50 rounded-lg p-3">
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">IMEI</dt>
                    <dd class="font-medium text-gray-900 mt-1">{{ $dispositivo->imei ?? '—' }}</dd>
                </div>
                <div class="bg-gray-50 rounded-lg p-3">
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</dt>
                    <dd class="font-medium text-gray-900 mt-1">
                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full 
                            {{ $dispositivo->estado === 'disponible' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $dispositivo->estado === 'asignado' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $dispositivo->estado === 'mantenimiento' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $dispositivo->estado === 'baja' ? 'bg-red-100 text-red-800' : '' }}">
                            {{ ucfirst($dispositivo->estado) }}
                        </span>
                    </dd>
                </div>
                <div class="bg-gray-50 rounded-lg p-3">
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de Compra</dt>
                    <dd class="font-medium text-gray-900 mt-1">{{ $dispositivo->fecha_compra?->format('d/m/Y') ?? '—' }}</dd>
                </div>
                <div class="md:col-span-2 bg-gray-50 rounded-lg p-3">
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Observaciones</dt>
                    <dd class="font-medium text-gray-900 mt-1">{{ $dispositivo->observaciones ?? 'Sin observaciones' }}</dd>
                </div>
            </dl>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-lg font-semibold text-gray-700 mb-4 border-b pb-2">
                <i class="fas fa-history mr-2 text-gray-500"></i>Historial de Asignaciones
            </h2>

            @if ($dispositivo->asignaciones->isEmpty())
                <p class="text-gray-500 text-center py-6"><i class="fas fa-inbox mr-2"></i>Este dispositivo no tiene asignaciones registradas.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Empleado</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Asignación</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Devolución</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Observaciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($dispositivo->asignaciones as $asignacion)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $asignacion->empleado->primer_nombre }} {{ $asignacion->empleado->apellido }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $asignacion->fecha_asignacion->format('d/m/Y H:i') }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $asignacion->fecha_devolucion?->format('d/m/Y H:i') ?? '—' }}</td>
                                    <td class="px-4 py-3">
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full {{ $asignacion->estado === 'activo' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-700' }}">
                                            {{ ucfirst($asignacion->estado) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $asignacion->observaciones ?? '—' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
