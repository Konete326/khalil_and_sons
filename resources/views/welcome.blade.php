<x-layouts.app>
    <x-sections.hero-scroll-canvas />

    @php
        $goldRate22k = \App\Models\GoldRate::where('karat', '22K')->first();
        $rateTola = $goldRate22k ? number_format($goldRate22k->rate_per_tola) : '227,333';
    @endphp

    <section id="collections" class="relative overflow-hidden bg-gradient-to-b from-oxblood-dark via-[#2e0909] to-ivory-base pt-24 pb-28 text-ivory-base">
        <div class="relative mx-auto max-w-7xl xl:max-w-[1400px] px-6 sm:px-8 lg:px-12">
            <div class="mx-auto max-w-3xl text-center">
                <div id="gold-rates" class="inline-flex flex-wrap items-center justify-center gap-2 border border-gold-antique/40 bg-oxblood-dark/80 px-4 py-1.5 backdrop-blur-md shadow-xl">
                    <span class="h-1.5 w-1.5 rounded-full bg-gold-antique animate-pulse"></span>
                    <span class="text-[10px] font-semibold tracking-[0.25em] text-gold-light uppercase">Karachi Sarafa 22K: Rs. {{ $rateTola }}/Tola</span>
                    <span class="text-gold-antique/40 hidden sm:inline">•</span>
                    <span class="text-[10px] font-medium tracking-widest text-gold-antique/90 uppercase hidden sm:inline">Murshid Bazaar Since 1991</span>
                </div>

                <h2 class="mt-8 font-serif text-3xl font-normal tracking-tight text-gold-light sm:text-4xl lg:text-5xl leading-tight">
                    The Royal Heirlooms & Masterpiece Collections
                </h2>

                <p class="mt-5 font-sans text-xs sm:text-sm leading-relaxed text-ivory-base/80 max-w-2xl mx-auto">
                    Artisanal bridal suites, royal uncut Polki, and certified hallmark treasures sculpted by master goldsmiths in Murshid Bazaar, Saddar, Karachi since 1991.
                </p>

                <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                    <button
                        type="button"
                        @click="window.customConfirm('Would you like to schedule a private bridal suite viewing at our Murshid Bazaar showroom?', () => window.notify('Private consultation reserved with our master goldsmiths.', 'success'), 'Private Consultation')"
                        class="bg-gold-antique px-7 py-3 text-xs font-semibold uppercase tracking-[0.2em] text-oxblood-dark shadow-xl transition hover:bg-gold-light"
                    >
                        Book Private Salon
                    </button>
                    <button
                        type="button"
                        @click="window.customAlert('Every Khalil & Sons creation is hallmarked at Karachi Sarafa Bazaar with verified 91.6% purity certification.', 'Hallmark Guarantee')"
                        class="border border-gold-antique/50 bg-white/10 backdrop-blur-sm px-7 py-3 text-xs font-semibold uppercase tracking-[0.2em] text-ivory-base transition hover:bg-gold-antique/20"
                    >
                        Hallmark Standard
                    </button>
                </div>
            </div>

            <div class="mt-16">
                <x-sections.collections-grid />
            </div>
        </div>
    </section>

    <x-ui.product-spec-modal />
</x-layouts.app>
