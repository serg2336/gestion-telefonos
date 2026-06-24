<div>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Empleados</h1>
        <a href="{{ route('empleados.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Nuevo Empleado</a>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-4">
        <input type="text" wire:model.live="search" placeholder="Buscar empleados..." class="border rounded px-4 py-2 w-full">
    </div>

    <table class="min-w-full bg-white border">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">Primer Nombre</th>
                <th class="px-4 py-2">Apellido</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Teléfono</th>
                <th class="px-4 py-2">Identificación</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empleados as $empleado)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $empleado->primer_nombre }}</td>
                    <td class="px-4 py-2">{{ $empleado->apellido }}</td>
                    <td class="px-4 py-2">{{ $empleado->email }}</td>
                    <td class="px-4 py-2">{{ $empleado->telefono }}</td>
                    <td class="px-4 py-2">{{ $empleado->identificacion }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('empleados.edit', $empleado->id) }}" class="text-blue-500 hover:underline">Editar</a>
                        <button wire:click="delete({{ $empleado->id }})" wire:confirm="¿Eliminar este empleado?" class="text-red-500 hover:underline ml-2">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $empleados->links() }}
    </div>
</div>