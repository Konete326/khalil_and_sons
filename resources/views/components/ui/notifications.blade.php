<div
    x-data
    class="fixed bottom-6 right-6 z-50 flex flex-col space-y-3 pointer-events-none max-w-sm w-full"
    aria-live="polite"
>
    <template x-for="item in $store.notifications.items" :key="item.id">
        <div
            x-transition:enter="transform ease-out duration-300 transition"
            x-transition:enter-start="translate-y-4 opacity-0 sm:translate-y-0 sm:translate-x-4"
            x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="pointer-events-auto flex items-start justify-between border border-gold-antique/60 bg-white p-4 shadow-xl"
        >
            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0 pt-0.5">
                    <span class="inline-block h-2 w-2 rounded-full bg-gold-antique"></span>
                </div>
                <div class="text-xs font-sans text-charcoal leading-relaxed" x-text="item.message"></div>
            </div>
            <button
                type="button"
                @click="$store.notifications.remove(item.id)"
                class="ml-4 flex-shrink-0 text-charcoal/40 hover:text-oxblood transition"
                aria-label="Dismiss notification"
            >
                <x-heroicon-o-x-mark class="h-4 w-4" />
            </button>
        </div>
    </template>
</div>
