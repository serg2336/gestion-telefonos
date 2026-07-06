<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <!-- Siempre visibles -->
                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Apellido</th>
                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                <!-- Ocultas en móviles, visibles en sm -->
                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase hidden sm:table-cell">Teléfono</th>
                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase hidden md:table-cell">Identificación</th>
                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase hidden sm:table-cell">Departamento</th>
                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($empleados as $empleado)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-3 py-2 whitespace-nowrap text-sm">{{ $empleado->primer_nombre }}</td>
                    <td class="px-3 py-2 whitespace-nowrap text-sm">{{ $empleado->apellido }}</td>
                    <td class="px-3 py-2 whitespace-nowrap text-sm">{{ $empleado->email }}</td>
                    <td class="px-3 py-2 whitespace-nowrap text-sm hidden sm:table-cell">{{ $empleado->telefono }}</td>
                    <td class="px-3 py-2 whitespace-nowrap text-sm hidden md:table-cell">{{ $empleado->identificacion }}</td>
                    <td class="px-3 py-2 whitespace-nowrap text-sm hidden sm:table-cell">{{ $empleado->departamento->nombre ?? 'Sin asignar' }}</td>
                    <td class="px-3 py-2 whitespace-nowrap text-sm">
                        <a href="{{ route('empleados.edit', $empleado->id) }}" class="text-blue-600 hover:text-blue-800">Editar</a>
                        <button wire:click="delete({{ $empleado->id }})" wire:confirm="¿Eliminar?" class="text-red-600 hover:text-red-800 ml-2">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>