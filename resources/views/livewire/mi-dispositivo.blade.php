<div class="py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">
            <i class="fas fa-mobile-alt mr-2 text-blue-600"></i>Mi Dispositivo
        </h1>

        @if (!$empleado)
            <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 px-6 py-4 rounded-lg text-sm">
                <i class="fas fa-exclamation-triangle mr-1.5"></i>
                No hay un empleado vinculado a tu cuenta. Consulta con el administrador.
            </div>
        @elseif (!$asignacionActiva)
            <div class="bg-blue-50 border border-blue-200 text-blue-800 px-6 py-4 rounded-lg text-sm">
                <i class="fas fa-info-circle mr-1.5"></i>
                No tienes ningún dispositivo asignado actualmente.
            </div>
        @else
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6 border-l-4 border-green-500">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">
                            {{ $asignacionActiva->dispositivo->marca }} {{ $asignacionActiva->dispositivo->modelo }}
                        </h2>
                        <p class="text-sm text-gray-500 mt-1">Dispositivo asignado</p>
                    </div>
                    <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $asignacionActiva->estado === 'activo' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ $asignacionActiva->estado === 'activo' ? 'Activo' : 'Pendiente de devolver' }}
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div class="bg-gray-50 rounded-lg p-3">
                        <span class="text-gray-500">Número de serie</span>
                        <p class="font-medium text-gray-800">{{ $asignacionActiva->dispositivo->numero_serie }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-3">
                        <span class="text-gray-500">IMEI</span>
                        <p class="font-medium text-gray-800">{{ $asignacionActiva->dispositivo->imei ?? '—' }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-3">
                        <span class="text-gray-500">Fecha de asignación</span>
                        <p class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($asignacionActiva->fecha_asignacion)->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-3">
                        <span class="text-gray-500">Estado del dispositivo</span>
                        <p class="font-medium text-gray-800">{{ ucfirst($asignacionActiva->dispositivo->estado) }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if ($empleado && $historial->isNotEmpty())
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">
                    <i class="fas fa-history mr-2 text-gray-500"></i>Historial de asignaciones
                </h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dispositivo</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Asignado</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Devuelto</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($historial as $a)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">
                                    {{ $a->dispositivo->marca }} {{ $a->dispositivo->modelo }}
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600">
                                    {{ \Carbon\Carbon::parse($a->fecha_asignacion)->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600">
                                    {{ $a->fecha_devolucion ? \Carbon\Carbon::parse($a->fecha_devolucion)->format('d/m/Y') : '—' }}
                                </td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                        {{ $a->estado === 'activo' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $a->estado === 'devuelto' ? 'bg-gray-100 text-gray-700' : '' }}
                                        {{ $a->estado === 'pendiente_devolver' ? 'bg-yellow-100 text-yellow-800' : '' }}">
                                        {{ ucfirst(str_replace('_', ' ', $a->estado)) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</div>
