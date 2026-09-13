<x-layouts.app :title="'Bespoke Bridal Atelier | Khalil & Sons Jewellers'">
    <x-sections.bespoke-scroll-canvas />

    <section id="bespoke-steps" class="relative overflow-hidden bg-gradient-to-b from-oxblood-dark via-[#230505] to-ivory-base pt-20 pb-28 text-ivory-base">
        <div class="relative mx-auto max-w-7xl xl:max-w-[1400px] px-6 sm:px-8 lg:px-12">
            <div class="mx-auto max-w-3xl text-center">
                <div class="inline-flex items-center space-x-2 border border-gold-antique/40 bg-oxblood-dark/80 px-4 py-1.5 backdrop-blur-md shadow-xl">
                    <span class="h-1.5 w-1.5 rounded-full bg-gold-antique animate-pulse"></span>
                    <span class="text-[10px] font-semibold tracking-[0.25em] text-gold-light uppercase">Bespoke Bridal Suite Atelier</span>
                </div>

                <h2 class="mt-8 font-serif text-3xl font-normal tracking-tight text-gold-light sm:text-4xl lg:text-5xl leading-tight">
                    From Hand Sketch to Royal Heirloom
                </h2>

                <p class="mt-5 font-sans text-xs sm:text-sm leading-relaxed text-ivory-base/80 max-w-2xl mx-auto">
                    Collaborate directly with our master goldsmiths in Murshid Bazaar. We sculpt custom bridal suites tailored to your personal aesthetic, fabric hues, and gem specifications.
                </p>
            </div>

            <div class="mt-16 grid grid-cols-1 gap-8 md:grid-cols-3">
                <div class="border border-gold-antique/30 bg-oxblood-dark/70 p-8 backdrop-blur-md shadow-xl transition hover:border-gold-antique">
                    <span class="font-serif text-xs uppercase tracking-[0.25em] text-gold-antique">Phase I</span>
                    <h3 class="mt-3 font-serif text-xl text-gold-light">Private Consultation</h3>
                    <p class="mt-3 text-xs leading-relaxed text-ivory-base/75">
                        Bring your bridal outfit and heirloom references. Our master designer hand-draws full-scale proportional sketches.
                    </p>
                </div>

                <div class="border border-gold-antique/30 bg-oxblood-dark/70 p-8 backdrop-blur-md shadow-xl transition hover:border-gold-antique">
                    <span class="font-serif text-xs uppercase tracking-[0.25em] text-gold-antique">Phase II</span>
                    <h3 class="mt-3 font-serif text-xl text-gold-light">Gemstone Selection</h3>
                    <p class="mt-3 text-xs leading-relaxed text-ivory-base/75">
                        Inspect certified Burmese rubies, Basra pearls, and syndicate uncut Polki diamonds selected specifically for your suite.
                    </p>
                </div>

                <div class="border border-gold-antique/30 bg-oxblood-dark/70 p-8 backdrop-blur-md shadow-xl transition hover:border-gold-antique">
                    <span class="font-serif text-xs uppercase tracking-[0.25em] text-gold-antique">Phase III</span>
                    <h3 class="mt-3 font-serif text-xl text-gold-light">Handcrafted Casting</h3>
                    <p class="mt-3 text-xs leading-relaxed text-ivory-base/75">
                        Forged in pure 22K gold by Saddar artisans with individual Jadau bezel settings and official Karachi Sarafa hallmarking.
                    </p>
                </div>
            </div>

            <div class="mt-16 border border-gold-antique/30 bg-oxblood-dark/80 p-8 sm:p-12 text-center backdrop-blur-md">
                <h3 class="font-serif text-2xl text-gold-light sm:text-3xl">Reserve Your Bespoke Atelier Session</h3>
                <p class="mt-3 text-xs sm:text-sm text-ivory-base/80 max-w-xl mx-auto">
                    Private design sessions are held by appointment at our flagship salon in Murshid Bazaar, Saddar, Karachi.
                </p>
                <div class="mt-8 flex flex-wrap justify-center gap-4">
                    <button
                        type="button"
                        @click="window.customConfirm('Reserve a 1-on-1 bespoke consultation with our master goldsmiths?', () => window.notify('Bespoke session request queued with concierge.', 'success'), 'Bespoke Atelier Booking')"
                        class="bg-gold-antique px-8 py-3.5 text-xs font-semibold tracking-widest text-oxblood-dark uppercase hover:bg-gold-light transition shadow-xl"
                    >
                        Initiate Custom Commission
                    </button>
                    <a
                        href="{{ route('about') }}"
                        class="border border-gold-antique/60 px-8 py-3.5 text-xs font-semibold tracking-widest text-gold-light uppercase hover:bg-white/10 transition backdrop-blur-sm"
                    >
                        Our Heritage Story &rarr;
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
