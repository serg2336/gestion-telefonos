<div x-data="{
    show: false,
    title: 'Confirmar acción',
    message: '¿Está seguro de realizar esta acción?',
    confirmText: 'Confirmar',
    confirmClass: 'bg-red-600 hover:bg-red-700',
    action: null,
    params: [],

    open(config) {
        this.title = config.title || this.title;
        this.message = config.message || this.message;
        this.confirmText = config.confirmText || this.confirmText;
        this.confirmClass = config.confirmClass || this.confirmClass;
        this.action = config.action;
        this.params = config.params || [];
        this.show = true;
    },

    confirm() {
        if (this.action) {
            $wire.call(this.action, ...this.params);
        }
        this.show = false;
    },

    cancel() {
        this.show = false;
    }
}"
x-on:open-confirmation-modal.window="open($event.detail)"
x-show="show"
x-cloak
class="fixed inset-0 z-50 flex items-center justify-center"
style="display: none;">
    <div class="fixed inset-0 bg-black/50 transition-opacity" x-show="show" x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @@click="cancel()"></div>
    <div x-show="show" x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="relative bg-white rounded-xl shadow-2xl p-6 w-full max-w-md mx-4 z-10">
        <div class="flex items-center gap-3 mb-4">
            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">
                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                </svg>
            </div>
            <h3 x-text="title" class="text-lg font-semibold text-gray-900"></h3>
        </div>
        <p x-text="message" class="text-sm text-gray-600 mb-6"></p>
        <div class="flex justify-end gap-3">
            <button @@click="cancel()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition">
                Cancelar
            </button>
            <button @@click="confirm()" x-text="confirmText" :class="confirmClass" class="px-4 py-2 text-sm font-medium text-white rounded-lg transition shadow-sm">
            </button>
        </div>
    </div>
</div>