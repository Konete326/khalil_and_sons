<aside
    class="hidden md:block border-b border-gold-antique/20 bg-oxblood-dark/95 px-4 py-1.5 text-gold-light"
    aria-label="Announcement"
>
    <div class="mx-auto flex max-w-7xl xl:max-w-[1400px] items-center justify-between text-center text-[10px] font-medium tracking-[0.2em] uppercase sm:px-6 lg:px-8 xl:px-12">
        <div class="flex items-center space-x-2 text-gold-light/80">
            <span>Murshid Bazaar, Saddar, Karachi</span>
            <span class="text-gold-antique">•</span>
            <span>Since 1991</span>
        </div>
        <div class="flex items-center space-x-4">
            <button
                type="button"
                @click="window.customConfirm('Would you like to request an exclusive private consultation with our master goldsmiths?', () => window.notify('Private consultation request registered with VIP concierge.', 'success'), 'Private Consultation')"
                class="underline hover:text-white transition"
            >
                Book Appointment
            </button>
        </div>
    </div>
</aside>
