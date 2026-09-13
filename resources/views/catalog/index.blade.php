<x-layouts.app>
    <section class="relative overflow-hidden bg-gradient-to-b from-oxblood-dark via-[#2e0909] to-ivory-base pt-16 pb-28 text-ivory-base min-h-screen">
        <div class="relative mx-auto max-w-7xl xl:max-w-[1400px] px-6 sm:px-8 lg:px-12">
            <div class="mx-auto max-w-3xl text-center mb-12">
                <div class="inline-flex items-center justify-center gap-2 border border-gold-antique/40 bg-oxblood-dark/80 px-4 py-1.5 backdrop-blur-md shadow-xl">
                    <span class="h-1.5 w-1.5 rounded-full bg-gold-antique animate-pulse"></span>
                    <span class="text-[10px] font-semibold tracking-[0.25em] text-gold-light uppercase">Murshid Bazaar Sarafa Standard</span>
                </div>
                <h1 class="mt-6 font-serif text-3xl font-normal tracking-tight text-gold-light sm:text-4xl lg:text-5xl">
                    The Masterpiece Collections
                </h1>
                <p class="mt-4 font-sans text-xs sm:text-sm text-ivory-base/80 max-w-2xl mx-auto leading-relaxed">
                    Explore transparent Saddar Sarafa gold valuations, 22K hallmark certifications, and bespoke Pakistani bridal jewellery.
                </p>
            </div>

            <x-sections.collections-grid />
        </div>
    </section>

    <x-ui.product-spec-modal />
</x-layouts.app>
