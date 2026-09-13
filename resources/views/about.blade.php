<x-layouts.app :title="'Our Heritage & Master Karigars | Khalil & Sons Jewellers'">
    <x-sections.about-scroll-canvas />

    <section id="heritage-story" class="relative overflow-hidden bg-gradient-to-b from-oxblood-dark via-[#240606] to-ivory-base pt-20 pb-28 text-ivory-base">
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <div class="inline-flex items-center space-x-2 border border-gold-antique/40 bg-oxblood-dark/80 px-4 py-1.5 backdrop-blur-md shadow-xl">
                    <span class="h-1.5 w-1.5 rounded-full bg-gold-antique animate-pulse"></span>
                    <span class="text-[10px] font-semibold tracking-[0.25em] text-gold-light uppercase">Established 1991 • Murshid Bazaar</span>
                </div>

                <h2 class="mt-8 font-serif text-3xl font-normal tracking-tight text-gold-light sm:text-4xl lg:text-5xl leading-tight">
                    Three Decades of Goldsmithing Excellence
                </h2>

                <p class="mt-5 font-sans text-xs sm:text-sm leading-relaxed text-ivory-base/80 max-w-2xl mx-auto">
                    Founded in 1991 in the historic Murshid Bazaar of Saddar, Karachi, Khalil & Sons has dedicated over thirty years to preserving ancient subcontinental goldsmithing techniques.
                </p>
            </div>

            <div class="mt-16 grid grid-cols-1 gap-8 md:grid-cols-3">
                <div class="border border-gold-antique/30 bg-oxblood-dark/70 p-8 backdrop-blur-md shadow-xl transition hover:border-gold-antique">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full border border-gold-antique/40 bg-oxblood text-gold-light">
                        <span class="font-serif text-lg font-semibold">I</span>
                    </div>
                    <h3 class="mt-6 font-serif text-xl text-gold-light">Artisanal Lineage</h3>
                    <p class="mt-3 text-xs leading-relaxed text-ivory-base/75">
                        Our master goldsmiths carry forward ancestral Karigari methods, from delicate filigree wirework to intricate repoussé carving.
                    </p>
                </div>

                <div class="border border-gold-antique/30 bg-oxblood-dark/70 p-8 backdrop-blur-md shadow-xl transition hover:border-gold-antique">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full border border-gold-antique/40 bg-oxblood text-gold-light">
                        <span class="font-serif text-lg font-semibold">II</span>
                    </div>
                    <h3 class="mt-6 font-serif text-xl text-gold-light">Sarafa Hallmark Standard</h3>
                    <p class="mt-3 text-xs leading-relaxed text-ivory-base/75">
                        Certified purity in 22K and 24K solid gold. Every piece is hallmarked with official assay verification and guaranteed authenticity.
                    </p>
                </div>

                <div class="border border-gold-antique/30 bg-oxblood-dark/70 p-8 backdrop-blur-md shadow-xl transition hover:border-gold-antique">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full border border-gold-antique/40 bg-oxblood text-gold-light">
                        <span class="font-serif text-lg font-semibold">III</span>
                    </div>
                    <h3 class="mt-6 font-serif text-xl text-gold-light">Bespoke Heirlooms</h3>
                    <p class="mt-3 text-xs leading-relaxed text-ivory-base/75">
                        Each bespoke commission is customized to the client's bridal ensemble, matching gemstones and hand-set uncut Polki diamonds.
                    </p>
                </div>
            </div>

            <div class="mt-16 border border-gold-antique/30 bg-oxblood-dark/80 p-8 sm:p-12 text-center backdrop-blur-md">
                <h3 class="font-serif text-2xl text-gold-light sm:text-3xl">Visit Our Saddar Boutique</h3>
                <p class="mt-3 text-xs sm:text-sm text-ivory-base/80 max-w-xl mx-auto">
                    Experience our royal bridal suites and private salon in Murshid Bazaar, Saddar, Karachi.
                </p>
                <div class="mt-6 flex flex-wrap justify-center gap-4">
                    <button
                        type="button"
                        @click="window.customConfirm('Would you like to reserve an exclusive consultation at our Murshid Bazaar boutique?', () => window.notify('Private consultation reserved.', 'success'), 'Boutique Consultation')"
                        class="bg-gold-antique px-8 py-3 text-xs font-semibold tracking-widest text-oxblood-dark uppercase hover:bg-gold-light transition shadow-xl"
                    >
                        Book Appointment
                    </button>
                    <a
                        href="{{ route('bespoke') }}"
                        class="border border-gold-antique/60 px-8 py-3 text-xs font-semibold tracking-widest text-gold-light uppercase hover:bg-white/10 transition backdrop-blur-sm"
                    >
                        Explore Bespoke Atelier &rarr;
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
