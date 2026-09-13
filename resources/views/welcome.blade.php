<x-layouts.app>
    <x-sections.hero-scroll-canvas />

    @php
        $goldRate22k = \App\Models\GoldRate::where('karat', '22K')->first();
        $rateTola = $goldRate22k ? number_format($goldRate22k->rate_per_tola) : '227,333';
    @endphp

    <section id="collections" class="relative overflow-hidden bg-gradient-to-b from-oxblood-dark via-[#2e0909] to-ivory-base pt-24 pb-28 text-ivory-base">
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
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

            <div class="mt-16 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <div class="group border border-gold-antique/30 bg-oxblood-dark/60 backdrop-blur-md p-6 shadow-xl transition duration-300 hover:-translate-y-1.5 hover:border-gold-antique">
                    <span class="font-serif text-[11px] tracking-widest text-gold-antique uppercase">Collection I</span>
                    <h3 class="mt-2 font-serif text-xl text-gold-light">Royal Bridal Suites</h3>
                    <p class="mt-2 text-xs text-ivory-base/70 leading-relaxed">22K solid gold bridal suites paired with unheated Burmese rubies and Basra pearls.</p>
                    <button
                        type="button"
                        @click="window.notify('Royal Bridal Suites catalogue queued.')"
                        class="mt-5 inline-flex items-center text-xs font-semibold tracking-wider text-gold-antique uppercase hover:text-gold-light transition"
                    >
                        Explore Suite &rarr;
                    </button>
                </div>

                <div class="group border border-gold-antique/30 bg-oxblood-dark/60 backdrop-blur-md p-6 shadow-xl transition duration-300 hover:-translate-y-1.5 hover:border-gold-antique">
                    <span class="font-serif text-[11px] tracking-widest text-gold-antique uppercase">Collection II</span>
                    <h3 class="mt-2 font-serif text-xl text-gold-light">Uncut Polki & Kundan</h3>
                    <p class="mt-2 text-xs text-ivory-base/70 leading-relaxed">Mughal Jadau craftsmanship featuring syndicate polki diamonds and emerald drops.</p>
                    <button
                        type="button"
                        @click="window.notify('Polki & Kundan vault inquiry queued.')"
                        class="mt-5 inline-flex items-center text-xs font-semibold tracking-wider text-gold-antique uppercase hover:text-gold-light transition"
                    >
                        Explore Vault &rarr;
                    </button>
                </div>

                <div class="group border border-gold-antique/30 bg-oxblood-dark/60 backdrop-blur-md p-6 shadow-xl transition duration-300 hover:-translate-y-1.5 hover:border-gold-antique">
                    <span class="font-serif text-[11px] tracking-widest text-gold-antique uppercase">Collection III</span>
                    <h3 class="mt-2 font-serif text-xl text-gold-light">Solitaires & Kadas</h3>
                    <p class="mt-2 text-xs text-ivory-base/70 leading-relaxed">Solid 22K hallmark-certified traditional kadas and certified brilliant diamond solitaires.</p>
                    <button
                        type="button"
                        @click="window.notify('Solitaires & Kadas inquiry queued.')"
                        class="mt-5 inline-flex items-center text-xs font-semibold tracking-wider text-gold-antique uppercase hover:text-gold-light transition"
                    >
                        Explore Pieces &rarr;
                    </button>
                </div>

                <div id="custom-atelier" class="group border border-gold-antique/30 bg-oxblood-dark/60 backdrop-blur-md p-6 shadow-xl transition duration-300 hover:-translate-y-1.5 hover:border-gold-antique">
                    <span class="font-serif text-[11px] tracking-widest text-gold-antique uppercase">Murshid Atelier</span>
                    <h3 class="mt-2 font-serif text-xl text-gold-light">Bespoke Commission</h3>
                    <p class="mt-2 text-xs text-ivory-base/70 leading-relaxed">Collaborate one-on-one with our master Karigars since 1991 in Murshid Bazaar, Saddar.</p>
                    <button
                        type="button"
                        @click="window.customConfirm('Start a bespoke commission with our master artisans?', () => window.notify('Atelier commission request initialized.', 'success'), 'Bespoke Atelier')"
                        class="mt-5 inline-flex items-center text-xs font-semibold tracking-wider text-gold-antique uppercase hover:text-gold-light transition"
                    >
                        Commission Design &rarr;
                    </button>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
