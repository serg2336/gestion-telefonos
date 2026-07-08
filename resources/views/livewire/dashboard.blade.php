<div>
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">

            <h1 class="text-2xl font-bold text-gray-800 mb-6">
                <i class="fas fa-tachometer-alt mr-2 text-blue-600"></i>
                {{ $esAdmin ? 'Panel de Administración' : 'Mi Panel' }}
            </h1>

            @if ($esAdmin)
                {{-- Admin: estadísticas globales --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-white rounded-xl shadow-sm border-l-4 border-blue-500 p-6 flex items-center gap-4">
                        <div class="bg-blue-100 p-3 rounded-lg">
                            <i class="fas fa-users text-2xl text-blue-600"></i>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500 font-medium">Total Empleados</div>
                            <div class="text-3xl font-bold text-gray-800">{{ $totalEmpleados }}</div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm border-l-4 border-emerald-500 p-6 flex items-center gap-4">
                        <div class="bg-emerald-100 p-3 rounded-lg">
                            <i class="fas fa-tablet-alt text-2xl text-emerald-600"></i>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500 font-medium">Total Dispositivos</div>
                            <div class="text-3xl font-bold text-gray-800">{{ $totalDispositivos }}</div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm border-l-4 border-amber-500 p-6 flex items-center gap-4">
                        <div class="bg-amber-100 p-3 rounded-lg">
                            <i class="fas fa-exchange-alt text-2xl text-amber-600"></i>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500 font-medium">Asignaciones Activas</div>
                            <div class="text-3xl font-bold text-amber-600">{{ $asignacionesActivas }}</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">
                        <i class="fas fa-bolt mr-2 text-yellow-500"></i>Accesos Rápidos
                    </h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        <a href="{{ route('empleados.index') }}" class="flex items-center gap-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white px-4 py-3 rounded-xl hover:from-blue-600 hover:to-blue-700 transition shadow-sm">
                            <i class="fas fa-users"></i><span>Empleados</span>
                        </a>
                        <a href="{{ route('empleados.create') }}" class="flex items-center gap-3 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white px-4 py-3 rounded-xl hover:from-emerald-600 hover:to-emerald-700 transition shadow-sm">
                            <i class="fas fa-user-plus"></i><span>Crear Empleado</span>
                        </a>
                        <a href="{{ route('dispositivos.index') }}" class="flex items-center gap-3 bg-gradient-to-r from-cyan-500 to-cyan-600 text-white px-4 py-3 rounded-xl hover:from-cyan-600 hover:to-cyan-700 transition shadow-sm">
                            <i class="fas fa-tablet-alt"></i><span>Dispositivos</span>
                        </a>
                        <a href="{{ route('asignaciones.index') }}" class="flex items-center gap-3 bg-gradient-to-r from-pink-500 to-pink-600 text-white px-4 py-3 rounded-xl hover:from-pink-600 hover:to-pink-700 transition shadow-sm">
                            <i class="fas fa-exchange-alt"></i><span>Asignaciones</span>
                        </a>
                        <a href="{{ route('departamentos.index') }}" class="flex items-center gap-3 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white px-4 py-3 rounded-xl hover:from-indigo-600 hover:to-indigo-700 transition shadow-sm">
                            <i class="fas fa-building"></i><span>Departamentos</span>
                        </a>
                        <a href="{{ route('profile') }}" class="flex items-center gap-3 bg-gradient-to-r from-purple-500 to-purple-600 text-white px-4 py-3 rounded-xl hover:from-purple-600 hover:to-purple-700 transition shadow-sm">
                            <i class="fas fa-id-card"></i><span>Mi Perfil</span>
                        </a>
                        <a href="{{ route('admin.register-user') }}" class="flex items-center gap-3 bg-gradient-to-r from-red-500 to-red-600 text-white px-4 py-3 rounded-xl hover:from-red-600 hover:to-red-700 transition shadow-sm">
                            <i class="fas fa-user-shield"></i><span>Registrar Usuario</span>
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">
                        <i class="fas fa-chart-line mr-2 text-blue-500"></i>Asignaciones por Mes
                    </h3>
                    <canvas id="chartAsignaciones" width="400" height="200"></canvas>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">
                        <i class="fas fa-history mr-2 text-gray-500"></i>Últimas 5 Asignaciones
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Empleado</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dispositivo</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Asignación</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($ultimasAsignaciones as $asignacion)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $asignacion->empleado->primer_nombre ?? 'N/A' }} {{ $asignacion->empleado->apellido ?? '' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ $asignacion->dispositivo->marca ?? 'N/A' }} {{ $asignacion->dispositivo->modelo ?? '' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ \Carbon\Carbon::parse($asignacion->fecha_asignacion)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full {{ $asignacion->estado == 'activo' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-700' }}">
                                            {{ ucfirst($asignacion->estado) }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500">No hay asignaciones registradas.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                {{-- Usuario regular: su información --}}
                @if (!$empleado)
                    <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 px-6 py-4 rounded-lg text-sm">
                        <i class="fas fa-exclamation-triangle mr-1.5"></i>
                        No hay un empleado vinculado a tu cuenta. Consulta con el administrador.
                    </div>
                @elseif (!$asignacionActiva)
                    <div class="bg-white rounded-xl shadow-sm p-8 text-center">
                        <i class="fas fa-mobile-alt text-5xl text-gray-300 mb-4"></i>
                        <h2 class="text-xl font-semibold text-gray-700 mb-2">Sin dispositivo asignado</h2>
                        <p class="text-gray-500 mb-6">Actualmente no tienes ningún dispositivo a tu cargo.</p>
                        <a href="{{ route('mi-dispositivo') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition text-sm font-medium">
                            Ver historial completo
                        </a>
                    </div>
                @else
                    <div class="bg-white rounded-xl shadow-sm p-6 mb-6 border-l-4 border-green-500">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <p class="text-sm text-gray-500">Tu dispositivo actual</p>
                                <h2 class="text-xl font-bold text-gray-800">
                                    {{ $asignacionActiva->dispositivo->marca }} {{ $asignacionActiva->dispositivo->modelo }}
                                </h2>
                            </div>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $asignacionActiva->estado === 'activo' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $asignacionActiva->estado === 'activo' ? 'Activo' : 'Pendiente de devolver' }}
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                            <div class="bg-gray-50 rounded-lg p-3">
                                <span class="text-gray-500">Número de serie</span>
                                <p class="font-medium text-gray-800">{{ $asignacionActiva->dispositivo->numero_serie }}</p>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-3">
                                <span class="text-gray-500">IMEI</span>
                                <p class="font-medium text-gray-800">{{ $asignacionActiva->dispositivo->imei ?? '—' }}</p>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-3">
                                <span class="text-gray-500">Asignado el</span>
                                <p class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($asignacionActiva->fecha_asignacion)->format('d/m/Y') }}</p>
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('mi-dispositivo') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                <i class="fas fa-chevron-right mr-1"></i>Ver historial completo
                            </a>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>

@if ($esAdmin)
@push('scripts')
<script>
    document.addEventListener('livewire:load', function () {
        const ctx = document.getElementById('chartAsignaciones').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Asignaciones',
                    data: @json($data),
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.1,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                }
            }
        });
    });
</script>
@endpush
@endif
