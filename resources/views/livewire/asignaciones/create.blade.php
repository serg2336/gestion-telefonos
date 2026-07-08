<div class="py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center gap-4 mb-6 border-b pb-4">
            <a href="{{ route('asignaciones.index') }}" class="text-gray-500 hover:text-gray-700" title="Volver">
                <i class="fas fa-arrow-left text-lg"></i>
            </a>
            <h1 class="text-xl font-bold text-gray-800">
                <i class="fas fa-exchange-alt mr-2 text-blue-600"></i>Nueva Asignación
            </h1>
        </div>

        @if (session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 text-sm">
                <i class="fas fa-exclamation-circle mr-1.5"></i>{{ session('error') }}
            </div>
        @endif

        <form wire:submit.prevent="save">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Empleado</label>
                    <div x-data="{
                        open: false,
                        query: '',
                        items: {{ $empleados->map(fn($e) => ['id' => (string)$e->id, 'label' => $e->primer_nombre.' '.$e->apellido.' ('.$e->identificacion.')'])->toJson() }},
                        get filtered() {
                            if (!this.query) return this.items;
                            return this.items.filter(i => i.label.toLowerCase().includes(this.query.toLowerCase()));
                        },
                        select(item) {
                            $wire.set('empleado_id', item.id);
                            this.query = item.label;
                            this.open = false;
                        }
                    }" class="relative">
                        <input type="text" x-model="query" @focus="open = true" @click.outside="open = false"
                            placeholder="Buscar empleado..."
                            class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <input type="hidden" wire:model="empleado_id">
                        <div x-show="open" x-cloak
                            class="absolute z-10 mt-1 w-full bg-white border rounded-lg shadow-lg max-h-60 overflow-y-auto">
                            <template x-for="item in filtered" :key="item.id">
                                <div @click="select(item)"
                                    class="px-4 py-2 hover:bg-blue-50 cursor-pointer text-sm border-b border-gray-100 last:border-0"
                                    x-text="item.label">
                                </div>
                            </template>
                            <div x-show="filtered.length === 0"
                                class="px-4 py-2 text-gray-400 text-sm text-center">
                                Sin resultados
                            </div>
                        </div>
                    </div>
                    @error('empleado_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Dispositivo</label>
                    <div x-data="{
                        open: false,
                        query: '',
                        items: {{ $dispositivos->map(fn($d) => ['id' => (string)$d->id, 'label' => $d->marca.' '.$d->modelo.' ('.$d->numero_serie.')'])->toJson() }},
                        get filtered() {
                            if (!this.query) return this.items;
                            return this.items.filter(i => i.label.toLowerCase().includes(this.query.toLowerCase()));
                        },
                        select(item) {
                            $wire.set('dispositivo_id', item.id);
                            this.query = item.label;
                            this.open = false;
                        }
                    }" class="relative">
                        <input type="text" x-model="query" @focus="open = true" @click.outside="open = false"
                            placeholder="Buscar dispositivo..."
                            class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <input type="hidden" wire:model="dispositivo_id">
                        <div x-show="open" x-cloak
                            class="absolute z-10 mt-1 w-full bg-white border rounded-lg shadow-lg max-h-60 overflow-y-auto">
                            <template x-for="item in filtered" :key="item.id">
                                <div @click="select(item)"
                                    class="px-4 py-2 hover:bg-blue-50 cursor-pointer text-sm border-b border-gray-100 last:border-0"
                                    x-text="item.label">
                                </div>
                            </template>
                            <div x-show="filtered.length === 0"
                                class="px-4 py-2 text-gray-400 text-sm text-center">
                                Sin resultados
                            </div>
                        </div>
                    </div>
                    @error('dispositivo_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Observaciones</label>
                    <textarea wire:model="observaciones" rows="3" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Motivo de la asignación..."></textarea>
                    @error('observaciones') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex justify-end items-center gap-4 mt-8 border-t pt-6">
                <a href="{{ route('asignaciones.index') }}" class="text-gray-600 hover:text-gray-800 transition text-sm">Cancelar</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition text-sm">
                    <i class="fas fa-check-circle mr-1.5"></i>Asignar Dispositivo
                </button>
            </div>
        </form>
    </div>
</div>
