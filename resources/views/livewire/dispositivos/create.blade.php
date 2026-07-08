<div class="py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center gap-4 mb-6 border-b pb-4">
            <a href="{{ route('dispositivos.index') }}" class="text-gray-500 hover:text-gray-700" title="Volver">
                <i class="fas fa-arrow-left text-lg"></i>
            </a>
            <h1 class="text-xl font-bold text-gray-800">
                <i class="fas fa-tablet-alt mr-2 text-blue-600"></i>Crear Nuevo Dispositivo
            </h1>
        </div>

        <form wire:submit.prevent="save">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Marca</label>
                    <input type="text" wire:model="marca" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('marca') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Modelo</label>
                    <input type="text" wire:model="modelo" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('modelo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Número de Serie</label>
                    <input type="text" wire:model="numero_serie" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('numero_serie') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">IMEI</label>
                    <input type="text" wire:model="imei" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('imei') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                    <select wire:model="estado" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="disponible">Disponible</option>
                        <option value="asignado">Asignado</option>
                        <option value="mantenimiento">Mantenimiento</option>
                        <option value="baja">Baja</option>
                        <option value="bloqueado">Bloqueado</option>
                    </select>
                    @error('estado') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Fecha de Compra</label>
                    <input type="date" wire:model="fecha_compra" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('fecha_compra') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

            </div>

            <div class="flex justify-end items-center gap-4 mt-8 border-t pt-6">
                <a href="{{ route('dispositivos.index') }}" class="text-gray-600 hover:text-gray-800 transition text-sm">Cancelar</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition text-sm">
                    <i class="fas fa-save mr-1.5"></i>Guardar Dispositivo
                </button>
            </div>
        </form>
    </div>
</div>
