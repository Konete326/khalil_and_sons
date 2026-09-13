<section id="hero-scroll-container" x-data data-base-url="{{ asset('assets/sequences/hero') }}" class="relative h-[450vh] bg-oxblood-dark">
    <div class="sticky top-0 flex h-screen w-full items-center justify-center overflow-hidden">
        <canvas id="hero-scroll-canvas" class="absolute inset-0 h-full w-full object-cover pointer-events-none"></canvas>

        <div
            x-show="!$store.heroScroll.isReady"
            x-transition:leave="transition ease-out duration-700"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="absolute inset-0 z-30 flex flex-col items-center justify-center bg-oxblood-dark/95 backdrop-blur-md"
        >
            <div class="relative flex h-24 w-24 items-center justify-center">
                <div class="absolute h-full w-full animate-spin rounded-full border-2 border-gold-antique/20 border-t-gold-antique"></div>
                <span class="font-serif text-sm font-semibold tracking-widest text-gold-light" x-text="$store.heroScroll.loaded + '%'"></span>
            </div>
            <p class="mt-4 font-serif text-xs uppercase tracking-[0.3em] text-gold-antique">Curating Royal Masterpieces</p>
        </div>

        <div class="pointer-events-none relative z-20 mx-auto flex h-full w-full max-w-7xl flex-col items-center justify-center px-4 sm:px-6 lg:px-8">
            <div
                x-show="$store.heroScroll.progress <= 0.28"
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
                    Master Goldsmiths of Saddar
                </h1>
                <p class="mt-4 font-sans text-xs sm:text-sm leading-relaxed text-ivory-base/80 max-w-xl">
                    Over three decades of artisanal master goldsmithing, sculpting regal heirlooms and magnificent bespoke bridal treasures.
                </p>
                <div class="mt-8 flex items-center space-x-4 pointer-events-auto">
                    <button
                        type="button"
                        @click="window.customConfirm('Would you like to reserve a private heritage consultation at our Saddar boutique?', () => window.notify('Consultation request forwarded to master concierge.', 'success'), 'Private Consultation')"
                        class="bg-gold-antique px-7 py-3 text-xs font-semibold tracking-[0.2em] text-oxblood-dark uppercase hover:bg-gold-light transition shadow-xl"
                    >
                        Explore Heritage
                    </button>
                </div>
            </div>

            <div
                x-show="$store.heroScroll.progress >= 0.35 && $store.heroScroll.progress <= 0.65"
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
                    <span class="text-[10px] font-semibold tracking-[0.3em] text-gold-light uppercase">Sarafa Hallmark Verified</span>
                </div>
                <h2 class="mt-6 font-serif text-3xl sm:text-5xl lg:text-6xl font-normal tracking-tight text-gold-light leading-tight">
                    22K Solid Gold Masterpieces
                </h2>
                <p class="mt-4 font-sans text-xs sm:text-sm leading-relaxed text-ivory-base/80 max-w-xl">
                    Hand-carved filigree and intricate chiseled textures forged in pristine 22-karat solid gold with certified hallmark purity.
                </p>
                <div class="mt-8 pointer-events-auto">
                    <button
                        type="button"
                        @click="window.customAlert('Each gold creation is hallmarked at Karachi Sarafa Bazaar with verified 91.6% purity certification.', 'Hallmark Verification')"
                        class="border border-gold-antique bg-oxblood/60 px-7 py-3 text-xs font-semibold tracking-[0.2em] text-gold-light uppercase hover:bg-gold-antique hover:text-oxblood-dark transition backdrop-blur-sm"
                    >
                        Verify Purity Standard
                    </button>
                </div>
            </div>

            <div
                x-show="$store.heroScroll.progress >= 0.72 && $store.heroScroll.progress <= 0.98"
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
                    <span class="text-[10px] font-semibold tracking-[0.3em] text-gold-light uppercase">Royal Bridal Splendor</span>
                </div>
                <h2 class="mt-6 font-serif text-3xl sm:text-5xl lg:text-6xl font-normal tracking-tight text-gold-light leading-tight">
                    Royal Burmese Rubies & Uncut Polki
                </h2>
                <p class="mt-4 font-sans text-xs sm:text-sm leading-relaxed text-ivory-base/80 max-w-xl">
                    Rare unheated pigeon-blood Burmese rubies paired with uncut diamonds in timeless Mughal bridal settings.
                </p>
                <div class="mt-8 flex flex-wrap justify-center gap-4 pointer-events-auto">
                    <button
                        type="button"
                        @click="window.customConfirm('Would you like to schedule a private viewing for the Burmese Ruby Bridal Suite?', () => window.notify('Bridal suite private salon viewing scheduled.', 'success'), 'Bridal Suite Viewing')"
                        class="bg-gold-antique px-7 py-3 text-xs font-semibold tracking-[0.2em] text-oxblood-dark uppercase hover:bg-gold-light transition shadow-xl"
                    >
                        Explore Bridal Suites
                    </button>
                    <button
                        type="button"
                        @click="window.notify('Catalogue for Burmese Rubies & Royal Polki added to request queue.')"
                        class="border border-gold-antique/70 bg-black/40 px-6 py-3 text-xs font-semibold tracking-[0.2em] text-gold-light uppercase hover:bg-white/10 transition backdrop-blur-sm"
                    >
                        Request Catalogue
                    </button>
                </div>
            </div>
        </div>

        <div
            x-show="$store.heroScroll.progress < 0.1 && $store.heroScroll.isReady"
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
