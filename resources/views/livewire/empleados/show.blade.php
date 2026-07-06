<div class="py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">{{ $empleado->primer_nombre }} {{ $empleado->apellido }}</h1>
            <div class="flex gap-2">
                <a href="{{ route('empleados.edit', $empleado->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Editar</a>
                <a href="{{ route('empleados.index') }}" class="text-gray-600 hover:text-gray-800 px-4 py-2">Volver</a>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4 border-b pb-2">Información del Empleado</h2>
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm text-gray-500">Nombre</dt>
                    <dd class="font-medium">{{ $empleado->primer_nombre }} {{ $empleado->apellido }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">Email</dt>
                    <dd class="font-medium">{{ $empleado->email }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">Teléfono</dt>
                    <dd class="font-medium">{{ $empleado->telefono ?? '—' }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">Identificación</dt>
                    <dd class="font-medium">{{ $empleado->identificacion }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">Departamento</dt>
                    <dd class="font-medium">{{ $empleado->departamento->nombre ?? 'Sin departamento' }}</dd>
                </div>
            </dl>
        </div>

        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4 border-b pb-2">Historial de Asignaciones</h2>

            @if ($empleado->asignaciones->isEmpty())
                <p class="text-gray-500 text-center py-4">Este empleado no tiene asignaciones registradas.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 text-left">Dispositivo</th>
                                <th class="px-4 py-2 text-left">Fecha Asignación</th>
                                <th class="px-4 py-2 text-left">Fecha Devolución</th>
                                <th class="px-4 py-2 text-left">Estado</th>
                                <th class="px-4 py-2 text-left">Observaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($empleado->asignaciones as $asignacion)
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $asignacion->dispositivo->marca }} {{ $asignacion->dispositivo->modelo }} ({{ $asignacion->dispositivo->numero_serie }})</td>
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
