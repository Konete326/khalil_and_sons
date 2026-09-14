<section id="about-scroll-container" x-data data-scroll-container data-sequence-path="{{ asset('assets/about/frame_') }}" data-total-frames="41" data-pad-length="6" data-extension="jpg" data-store-key="aboutScroll" class="relative h-[350vh] sm:h-[400vh] bg-oxblood-dark">
    <div class="sticky top-0 flex h-[100dvh] w-full items-center justify-center overflow-hidden">
        <canvas id="about-scroll-canvas" class="absolute inset-0 h-full w-full object-cover pointer-events-none"></canvas>

        <div
            x-show="!$store.aboutScroll.isReady"
            x-cloak
            x-transition:leave="transition ease-out duration-700"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="absolute inset-0 z-30 flex flex-col items-center justify-center bg-oxblood-dark/95 backdrop-blur-md pointer-events-none"
        >
            <div class="relative flex h-24 w-24 items-center justify-center">
                <div class="absolute h-full w-full animate-spin rounded-full border-2 border-gold-antique/20 border-t-gold-antique"></div>
                <span class="font-serif text-sm font-semibold tracking-widest text-gold-light" x-text="$store.aboutScroll.loaded + '%'"></span>
            </div>
            <p class="mt-4 font-serif text-xs uppercase tracking-[0.3em] text-gold-antique">Unveiling Saddar Atelier</p>
        </div>

        <div class="pointer-events-none relative z-20 mx-auto flex h-full w-full max-w-7xl flex-col items-center justify-center px-4 sm:px-6 lg:px-8">
            <div
                x-show="$store.aboutScroll.progress <= 0.32"
                x-transition:enter="transition ease-out duration-500 transform"
                x-transition:enter-start="opacity-0 translate-y-6"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-300 transform"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-6"
                class="flex flex-col items-center text-center max-w-3xl"
            >
                <div class="inline-flex items-center space-x-2 border border-gold-antique/60 bg-oxblood/80 px-4 py-1.5 backdrop-blur-sm shadow-lg">
                    <span class="h-1.5 w-1.5 rounded-full bg-gold-antique"></span>
                    <span class="text-[10px] font-semibold tracking-[0.3em] text-gold-light uppercase">Heritage Since 1991</span>
                </div>
                <h1 class="mt-6 font-serif text-3xl sm:text-5xl lg:text-6xl font-normal tracking-tight text-gold-light leading-tight">
                    Master Artisans of Saddar
                </h1>
                <p class="mt-4 font-sans text-xs sm:text-sm leading-relaxed text-ivory-base/80 max-w-xl">
                    Established in 1991 in Murshid Bazaar, Saddar, Karachi. Three decades dedicated to artisanal goldsmithing and fine heirlooms.
                </p>
                <div class="mt-8 pointer-events-auto">
                    <a
                        href="#heritage-story"
                        class="inline-block bg-gold-antique px-7 py-3 text-xs font-semibold tracking-[0.2em] text-oxblood-dark uppercase hover:bg-gold-light transition shadow-xl"
                    >
                        Read Our Story
                    </a>
                </div>
            </div>

            <div
                x-show="$store.aboutScroll.progress >= 0.38 && $store.aboutScroll.progress <= 0.68"
                x-cloak
                x-transition:enter="transition ease-out duration-500 transform"
                x-transition:enter-start="opacity-0 translate-y-6"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-300 transform"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-6"
                class="flex flex-col items-center text-center max-w-3xl"
            >
                <div class="inline-flex items-center space-x-2 border border-gold-antique/60 bg-oxblood/80 px-4 py-1.5 backdrop-blur-sm shadow-lg">
                    <span class="h-1.5 w-1.5 rounded-full bg-gold-antique"></span>
                    <span class="text-[10px] font-semibold tracking-[0.3em] text-gold-light uppercase">Centuries-Old Craftsmanship</span>
                </div>
                <h2 class="mt-6 font-serif text-3xl sm:text-5xl lg:text-6xl font-normal tracking-tight text-gold-light leading-tight">
                    Mughal Jewellery Techniques
                </h2>
                <p class="mt-4 font-sans text-xs sm:text-sm leading-relaxed text-ivory-base/80 max-w-xl">
                    Hand-forged filigree, delicate wirework, and pure 22K alloy blending preserved across generations of master goldsmiths.
                </p>
                <div class="mt-8 pointer-events-auto">
                    <button
                        type="button"
                        @click="window.customAlert('Our master artisans employ authentic Mughal techniques including Jadau setting, hand chasing, and pure alloy blending.', 'Atelier Techniques')"
                        class="border border-gold-antique bg-oxblood/60 px-7 py-3 text-xs font-semibold tracking-[0.2em] text-gold-light uppercase hover:bg-gold-antique hover:text-oxblood-dark transition backdrop-blur-sm"
                    >
                        Artisan Techniques
                    </button>
                </div>
            </div>

            <div
                x-show="$store.aboutScroll.progress >= 0.72 && $store.aboutScroll.progress <= 0.98"
                x-cloak
                x-transition:enter="transition ease-out duration-500 transform"
                x-transition:enter-start="opacity-0 translate-y-6"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-300 transform"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-6"
                class="flex flex-col items-center text-center max-w-3xl"
            >
                <div class="inline-flex items-center space-x-2 border border-gold-antique/60 bg-oxblood/80 px-4 py-1.5 backdrop-blur-sm shadow-lg">
                    <span class="h-1.5 w-1.5 rounded-full bg-gold-antique"></span>
                    <span class="text-[10px] font-semibold tracking-[0.3em] text-gold-light uppercase">Purity Standard</span>
                </div>
                <h2 class="mt-6 font-serif text-3xl sm:text-5xl lg:text-6xl font-normal tracking-tight text-gold-light leading-tight">
                    Lifetime Hallmark Guarantee
                </h2>
                <p class="mt-4 font-sans text-xs sm:text-sm leading-relaxed text-ivory-base/80 max-w-xl">
                    In-house karat testing, certified hallmark standards, and a lifetime purity guarantee backed by our Saddar showroom.
                </p>
                <div class="mt-8 flex flex-wrap justify-center gap-4 pointer-events-auto">
                    <button
                        type="button"
                        @click="window.customConfirm('Schedule a visit to our Murshid Bazaar atelier to meet our master artisans?', () => window.notify('Appointment request registered.', 'success'), 'Private Atelier Visit')"
                        class="bg-gold-antique px-7 py-3 text-xs font-semibold tracking-[0.2em] text-oxblood-dark uppercase hover:bg-gold-light transition shadow-xl"
                    >
                        Visit Boutique
                    </button>
                </div>
            </div>
        </div>

        <div
            x-show="$store.aboutScroll.progress < 0.1 && $store.aboutScroll.isReady"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="pointer-events-none absolute bottom-8 z-20 flex flex-col items-center space-y-2 text-gold-light/60"
        >
            <span class="text-[9px] uppercase tracking-[0.3em]">Scroll to Discover</span>
            <div class="h-8 w-4 rounded-full border border-gold-antique/40 p-1">
                <div class="h-1.5 w-1.5 animate-bounce rounded-full bg-gold-antique mx-auto"></div>
            </div>
        </div>
    </div>
</section>
