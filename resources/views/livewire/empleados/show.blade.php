<div class="py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div class="flex items-center gap-3">
                <a href="{{ route('empleados.index') }}" class="text-gray-500 hover:text-gray-700" title="Volver">
                    <i class="fas fa-arrow-left text-lg"></i>
                </a>
                <h1 class="text-2xl font-bold text-gray-800">{{ $empleado->primer_nombre }} {{ $empleado->apellido }}</h1>
            </div>
            @if(auth()->user()->rol === 'admin')
                <a href="{{ route('empleados.edit', $empleado->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition text-sm font-medium shadow-sm">
                    <i class="fas fa-edit mr-1.5"></i>Editar
                </a>
            @endif
        </div>

        @php $tienePendientes = $empleado->tienePendientes(); @endphp

        @if ($tienePendientes)
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 text-sm flex items-center gap-2">
                <i class="fas fa-exclamation-triangle"></i>
                <span>Este empleado tiene dispositivos pendientes de devolver. No puede recibir nuevas asignaciones hasta que regularice su situación.</span>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-700 mb-4 border-b pb-2">
                <i class="fas fa-info-circle mr-2 text-blue-500"></i>Información del Empleado
            </h2>
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-gray-50 rounded-lg p-3">
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre Completo</dt>
                    <dd class="font-medium text-gray-900 mt-1">{{ $empleado->primer_nombre }} {{ $empleado->apellido }}</dd>
                </div>
                <div class="bg-gray-50 rounded-lg p-3">
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Email</dt>
                    <dd class="font-medium text-gray-900 mt-1">{{ $empleado->email }}</dd>
                </div>
                <div class="bg-gray-50 rounded-lg p-3">
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Teléfono</dt>
                    <dd class="font-medium text-gray-900 mt-1">{{ $empleado->telefono ?? '—' }}</dd>
                </div>
                <div class="bg-gray-50 rounded-lg p-3">
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Identificación</dt>
                    <dd class="font-medium text-gray-900 mt-1">{{ $empleado->identificacion }}</dd>
                </div>
                <div class="bg-gray-50 rounded-lg p-3">
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Departamento</dt>
                    <dd class="font-medium text-gray-900 mt-1">
                        <span class="px-2.5 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">{{ $empleado->departamento->nombre ?? 'Sin departamento' }}</span>
                    </dd>
                </div>
            </dl>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-lg font-semibold text-gray-700 mb-4 border-b pb-2">
                <i class="fas fa-history mr-2 text-gray-500"></i>Historial de Asignaciones
            </h2>

            @if ($empleado->asignaciones->isEmpty())
                <p class="text-gray-500 text-center py-6"><i class="fas fa-inbox mr-2"></i>Este empleado no tiene asignaciones registradas.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dispositivo</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Asignación</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Devolución</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Observaciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($empleado->asignaciones as $asignacion)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $asignacion->dispositivo->marca }} {{ $asignacion->dispositivo->modelo }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $asignacion->fecha_asignacion->format('d/m/Y H:i') }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $asignacion->fecha_devolucion?->format('d/m/Y H:i') ?? '—' }}</td>
                                    <td class="px-4 py-3">
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full
                                            {{ $asignacion->estado === 'activo' ? 'bg-green-100 text-green-800' : '' }}
                                            {{ $asignacion->estado === 'pendiente_devolver' ? 'bg-red-100 text-red-800' : '' }}
                                            {{ $asignacion->estado === 'devuelto' ? 'bg-gray-100 text-gray-700' : '' }}">
                                            @if ($asignacion->estado === 'pendiente_devolver')
                                                Pendiente
                                            @else
                                                {{ ucfirst($asignacion->estado) }}
                                            @endif
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
