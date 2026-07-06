<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Tarjetas de estadísticas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                    <div class="text-sm text-gray-500">Total Empleados</div>
                    <div class="text-3xl font-bold text-gray-800">{{ $totalEmpleados }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                    <div class="text-sm text-gray-500">Total Dispositivos</div>
                    <div class="text-3xl font-bold text-gray-800">{{ $totalDispositivos }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                    <div class="text-sm text-gray-500">Asignaciones Activas</div>
                    <div class="text-3xl font-bold text-green-600">{{ $asignacionesActivas }}</div>
                </div>
            </div>
             
            <!-- Enlaces rápidos -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Accesos Rápidos</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    
                    <a href="{{ route('dashboard') }}" class="bg-blue-500 text-white px-4 py-3 rounded text-center hover:bg-blue-600">Dashboard</a>
                    <a href="{{ route('empleados.index') }}" class="bg-green-500 text-white px-4 py-3 rounded text-center hover:bg-green-600">  <i class="fas fa-users mr-2"></i> Empleados</a>
                    <a href="{{ route('empleados.create') }}" class="bg-yellow-500 text-white px-4 py-3 rounded text-center hover:bg-yellow-600">Crear Empleado</a>
                     <a href="{{ route('departamentos.index') }}" class="bg-indigo-500 text-white px-4 py-3 rounded text-center hover:bg-indigo-600">Departamentos</a>
                    <a href="{{ route('profile') }}" class="bg-purple-500 text-white px-4 py-3 rounded text-center hover:bg-purple-600">Perfil</a>
                    @if(auth()->user()->rol === 'admin')
                        <a href="{{ route('register') }}" class="bg-red-500 text-white px-4 py-3 rounded text-center hover:bg-red-600">Registrar Usuario</a>
                    @endif
                    {{-- Enlaces para futuros módulos de compañeros --}}
                    {{-- <a href="{{ route('dispositivos.index') }}" class="bg-indigo-500 text-white px-4 py-3 rounded text-center hover:bg-indigo-600">Dispositivos</a> --}}
                    {{-- <a href="{{ route('asignaciones.index') }}" class="bg-pink-500 text-white px-4 py-3 rounded text-center hover:bg-pink-600">Asignaciones</a> --}}
                </div>
            </div>

            <!-- Gráfico -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Asignaciones por Mes</h3>
                <canvas id="chartAsignaciones" width="400" height="200"></canvas>
            </div>
       
            <!-- Tabla de últimas asignaciones -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Últimas 5 Asignaciones</h3>
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
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $asignacion->empleado->primer_nombre ?? 'N/A' }} {{ $asignacion->empleado->apellido ?? '' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $asignacion->dispositivo->modelo ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($asignacion->fecha_asignacion)->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $asignacion->estado == 'activo' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($asignacion->estado) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">No hay asignaciones registradas.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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