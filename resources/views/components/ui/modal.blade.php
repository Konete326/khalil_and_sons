<div
    x-data
    x-cloak
    x-show="$store.modal.isOpen"
    @keydown.escape.window="$store.modal.close()"
    class="fixed inset-0 z-50 overflow-y-auto"
    aria-labelledby="modal-title"
    role="dialog"
    aria-modal="true"
>
    <div
        x-show="$store.modal.isOpen"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-charcoal/80 backdrop-blur-sm"
        @click="$store.modal.close()"
    ></div>

    <div class="flex min-h-full items-center justify-center p-4 text-center">
        <div
            x-show="$store.modal.isOpen"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-4"
            class="relative w-full max-w-lg transform overflow-hidden rounded-none border border-gold-antique/50 bg-ivory-base p-8 text-left shadow-2xl transition-all"
        >
            <div class="flex items-center justify-between border-b border-gold-antique/20 pb-4">
                <div class="flex items-center space-x-3">
                    <span class="flex h-8 w-8 items-center justify-center border border-gold-antique bg-oxblood text-xs font-serif tracking-widest text-gold-light">
                        K&S
                    </span>
                    <h3 id="modal-title" class="font-serif text-xl font-semibold tracking-wide text-oxblood" x-text="$store.modal.title"></h3>
                </div>
                <button
                    type="button"
                    @click="$store.modal.close()"
                    class="text-charcoal/60 transition hover:text-oxblood"
                    aria-label="Close modal"
                >
                    <x-heroicon-o-x-mark class="h-5 w-5" />
                </button>
            </div>

            <div class="mt-6">
                <p class="font-sans text-sm leading-relaxed text-charcoal/80" x-text="$store.modal.message"></p>
            </div>

            <div class="mt-8 flex items-center justify-end space-x-4 border-t border-gold-antique/20 pt-5">
                <template x-if="$store.modal.type === 'confirm'">
                    <button
                        type="button"
                        @click="$store.modal.close()"
                        class="px-5 py-2.5 text-xs font-medium tracking-widest uppercase text-charcoal border border-charcoal/30 hover:border-oxblood hover:text-oxblood transition"
                        x-text="$store.modal.cancelLabel"
                    ></button>
                </template>

                <button
                    type="button"
                    @click="$store.modal.type === 'confirm' ? $store.modal.confirm() : $store.modal.close()"
                    class="bg-oxblood px-6 py-2.5 text-xs font-medium tracking-widest uppercase text-gold-light border border-gold-antique/40 hover:bg-oxblood-dark transition shadow-md"
                    x-text="$store.modal.confirmLabel"
                ></button>
            </div>
        </div>
    </div>
</div>
