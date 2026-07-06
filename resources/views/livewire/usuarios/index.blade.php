<div>
    <h1 class="text-2xl font-bold mb-4">Gestión de Usuarios</h1>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left">ID</th>
                    <th class="px-4 py-2 text-left">Nombre</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">Rol</th>
                    <th class="px-4 py-2 text-left">Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $user->id }}</td>
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2">
                            <select wire:model.live="selectedRoles.{{ $user->id }}" class="border rounded px-2 py-1">
                                <option value="user">Usuario</option>
                                <option value="admin">Administrador</option>
                            </select>
                        </td>
                        <td class="px-4 py-2">
                            <button wire:click="updateRole({{ $user->id }})" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Guardar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>