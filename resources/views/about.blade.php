<x-layouts.app :title="'Our Heritage & Master Karigars | Khalil & Sons Jewellers'">
    <x-sections.about-scroll-canvas />

    <section id="heritage-story" class="relative overflow-hidden bg-gradient-to-b from-oxblood-dark via-[#240606] to-ivory-base pt-20 pb-28 text-ivory-base">
        <div class="relative mx-auto max-w-7xl xl:max-w-[1400px] px-6 sm:px-8 lg:px-12">
            <div class="mx-auto max-w-3xl text-center mb-16 md:mb-24">
                <div class="inline-flex items-center space-x-2 border border-gold-antique/40 bg-oxblood-dark/80 px-4 py-1.5 backdrop-blur-md shadow-xl">
                    <span class="h-1.5 w-1.5 rounded-full bg-gold-antique animate-pulse"></span>
                    <span class="text-[10px] font-semibold tracking-[0.25em] text-gold-light uppercase">Established 1991 • Murshid Bazaar</span>
                </div>

                <h2 class="mt-8 font-serif text-3xl font-normal tracking-tight text-gold-light sm:text-4xl lg:text-5xl leading-tight">
                    Three Decades of Goldsmithing Excellence
                </h2>

                <p class="mt-5 font-sans text-xs sm:text-sm leading-relaxed text-ivory-base/80 max-w-2xl mx-auto">
                    Founded in 1991 in the historic Murshid Bazaar of Saddar, Karachi, Khalil & Sons has dedicated thirty-five years to preserving ancient subcontinental goldsmithing techniques.
                </p>
            </div>

            <div class="space-y-20 md:space-y-32">
                <div class="flex flex-col md:flex-row items-center gap-8 md:gap-14 lg:gap-16">
                    <div class="w-full md:w-1/2 space-y-4">
                        <span class="font-serif text-xs uppercase tracking-[0.25em] text-gold-antique">Heritage Milestone I</span>
                        <h3 class="font-serif text-2xl sm:text-3xl lg:text-4xl text-gold-light leading-snug">The 1991 Murshid Bazaar Legacy</h3>
                        <p class="text-xs sm:text-sm leading-relaxed text-ivory-base/80">
                            For over thirty-five years, Khalil & Sons has stood as an anchor of authenticity in Karachi's famed Murshid Bazaar. Rooted in traditional craftsmanship, our master artisans have designed royal bridal suites for generations of Pakistani families.
                        </p>
                        <div class="pt-2 flex items-center gap-4 text-xs font-mono text-gold-antique">
                            <span>• 35+ Years Heritage</span>
                            <span>• Saddar Karachi</span>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2">
                        <div class="relative aspect-video w-full overflow-hidden border-2 border-gold-antique/50 bg-black/60 shadow-2xl rounded-sm">
                            <video
                                src="{{ asset('assets/about/logo-video.mp4') }}"
                                autoplay
                                muted
                                loop
                                playsinline
                                class="h-full w-full object-cover"
                            ></video>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row-reverse items-center gap-8 md:gap-14 lg:gap-16">
                    <div class="w-full md:w-1/2 space-y-4">
                        <span class="font-serif text-xs uppercase tracking-[0.25em] text-gold-antique">Heritage Milestone II</span>
                        <h3 class="font-serif text-2xl sm:text-3xl lg:text-4xl text-gold-light leading-snug">Pure 22K Solid Craftsmanship & Hallmarking</h3>
                        <p class="text-xs sm:text-sm leading-relaxed text-ivory-base/80">
                            Every piece sculpted at Khalil & Sons adheres to rigorous Sarafa standards. We work exclusively with certified 22K and 24K pure gold, hand-inspected for hallmarking and structural endurance by master Karigars carrying generational knowledge.
                        </p>
                        <div class="pt-2 flex items-center gap-4 text-xs font-mono text-gold-antique">
                            <span>• 91.6% Pure Gold</span>
                            <span>• Sarafa Hallmark Verified</span>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2">
                        <div class="relative aspect-video w-full overflow-hidden border-2 border-gold-antique/60 bg-black/60 shadow-2xl rounded-sm">
                            <img
                                src="{{ asset('assets/about/brand-poster.jpg') }}"
                                alt="Pure 22K Solid Gold Hallmarking Standard"
                                class="h-full w-full object-cover"
                                loading="lazy"
                            />
                        </div>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row items-center gap-8 md:gap-14 lg:gap-16">
                    <div class="w-full md:w-1/2 space-y-4">
                        <span class="font-serif text-xs uppercase tracking-[0.25em] text-gold-antique">Heritage Milestone III</span>
                        <h3 class="font-serif text-2xl sm:text-3xl lg:text-4xl text-gold-light leading-snug">Flagship Saddar Atelier Experience</h3>
                        <p class="text-xs sm:text-sm leading-relaxed text-ivory-base/80">
                            Our boutique in Murshid Bazaar offers an intimate bridal salon experience. Clients collaborate directly with our master goldsmiths to customize neckwear, bangles, and heirloom polki sets tailored specifically to their wedding trousseau.
                        </p>
                        <div class="pt-2 flex items-center gap-4 text-xs font-mono text-gold-antique">
                            <span>• Private Bridal Salons</span>
                            <span>• VIP Concierge</span>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2">
                        <div class="relative aspect-video w-full overflow-hidden border-2 border-gold-antique/50 bg-black/60 shadow-2xl rounded-sm">
                            <img
                                src="{{ asset('assets/about/shop-front.jpg') }}"
                                alt="Flagship Saddar Atelier Experience"
                                class="h-full w-full object-cover"
                                loading="lazy"
                            />
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-24 border border-gold-antique/30 bg-oxblood-dark/80 p-8 sm:p-12 text-center backdrop-blur-md">
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
