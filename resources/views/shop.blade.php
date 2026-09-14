<x-layouts.app :title="'High Jewellery Collections & 3D Showcase | Khalil & Sons Jewellers'">
    <section class="relative overflow-hidden bg-gradient-to-b from-oxblood-dark via-[#240404] to-ivory-base pt-14 pb-28 text-ivory-base min-h-screen">
        <div class="relative mx-auto max-w-7xl xl:max-w-[1400px] px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center mb-10">
                <div class="inline-flex items-center gap-2 border border-gold-antique/40 bg-oxblood-dark/80 px-4 py-1.5 backdrop-blur-md shadow-xl">
                    <span class="h-1.5 w-1.5 rounded-full bg-gold-antique animate-pulse"></span>
                    <span class="text-[10px] font-semibold tracking-[0.25em] text-gold-light uppercase">Saddar Murshid Bazaar Flagship Salon</span>
                </div>
                <h1 class="mt-5 font-serif text-3xl sm:text-4xl lg:text-5xl font-normal tracking-tight text-gold-light">Masterpiece Collections</h1>
                <p class="mt-3 font-sans text-xs sm:text-sm text-ivory-base/80 max-w-xl mx-auto leading-relaxed">Pure 22K & 21K hallmark gold bridal heirlooms, calibrated with real-time Sarafa bullion spot pricing and interactive 3D inspection.</p>
            </div>

            <div
                x-data="{
                    activeTab: '{{ $activeCategory }}', activeKarat: '{{ $activeKarat }}', currency: 'PKR',
                    currencies: {{ Js::from($currencies) }}, symbols: {{ Js::from($symbols) }}, products: {{ Js::from($products) }}, inspecting3D: {},
                    formatPrice(totalPkr) {
                        let rate = parseFloat(this.currencies[this.currency] || 1); let sym = this.symbols[this.currency] || 'Rs.';
                        if (this.currency === 'PKR') return sym + ' ' + Math.round(totalPkr).toLocaleString('en-US');
                        return sym + ' ' + (totalPkr / rate).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                    },
                    filteredProducts() {
                        return this.products.filter(p => (this.activeTab === 'all' || p.category_slug === this.activeTab) && (this.activeKarat === 'all' || p.karat === this.activeKarat));
                    },
                    openSpec(product) { $dispatch('open-product-spec', { product, currency: this.currency }); }
                }"
                @currency-change.window="currency = $event.detail"
                class="w-full space-y-8"
            >
                <div class="flex flex-col lg:flex-row items-center justify-between gap-4 border-b border-gold-antique/20 pb-5">
                    <div class="flex items-center gap-2 overflow-x-auto max-w-full pb-2 lg:pb-0 scrollbar-none text-xs">
                        <button type="button" @click="activeTab = 'all'" :class="activeTab === 'all' ? 'bg-gold-antique text-oxblood-dark font-semibold' : 'text-ivory-base/80 hover:text-gold-light border border-gold-antique/30 bg-oxblood-dark/40'" class="px-3.5 py-1.5 uppercase tracking-wider transition">All Pieces</button>
                        @foreach($categories as $cat)
                            <button type="button" @click="activeTab = '{{ $cat->slug }}'" :class="activeTab === '{{ $cat->slug }}' ? 'bg-gold-antique text-oxblood-dark font-semibold' : 'text-ivory-base/80 hover:text-gold-light border border-gold-antique/30 bg-oxblood-dark/40'" class="px-3.5 py-1.5 uppercase tracking-wider transition flex-shrink-0">{{ $cat->name }}</button>
                        @endforeach
                    </div>

                    <div class="flex items-center gap-3 font-mono text-xs">
                        <span class="text-[10px] uppercase tracking-wider text-gold-antique">Karat:</span>
                        <div class="inline-flex border border-gold-antique/30 bg-oxblood-dark/80 p-0.5">
                            <template x-for="k in ['all', '24K', '22K', '21K', '18K']" :key="k">
                                <button type="button" @click="activeKarat = k" :class="activeKarat === k ? 'bg-gold-antique text-oxblood-dark font-bold' : 'text-ivory-base/70 hover:text-gold-light'" class="px-2 py-0.5 text-[10px] uppercase transition" x-text="k === 'all' ? 'All' : k"></button>
                            </template>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <template x-for="product in filteredProducts()" :key="product.id">
                        <div class="group relative flex flex-col justify-between border border-gold-antique/30 bg-oxblood-dark/80 backdrop-blur-md p-5 shadow-2xl transition-all duration-300 hover:border-gold-antique">
                            <div>
                                <div class="relative aspect-square w-full overflow-hidden bg-black/60 border border-gold-antique/20 mb-4">
                                    <template x-if="inspecting3D[product.id] && product.model_3d_url">
                                        <div class="relative w-full h-full">
                                            <model-viewer :src="product.model_3d_url" :alt="product.title" auto-rotate camera-controls shadow-intensity="1.5" exposure="1.2" class="w-full h-full"></model-viewer>
                                            <button type="button" @click="inspecting3D[product.id] = false" class="absolute top-2 right-2 bg-black/80 border border-gold-antique/40 px-2 py-0.5 text-[9px] text-gold-light">Photo View</button>
                                            <div class="absolute bottom-1 left-1 right-1 bg-oxblood-dark/90 text-center text-[8px] text-ivory-base/70 py-0.5">Drag to Rotate • Zoom</div>
                                        </div>
                                    </template>
                                    <template x-if="!inspecting3D[product.id] || !product.model_3d_url">
                                        <div class="relative w-full h-full">
                                            <img :src="product.images && product.images[0] ? product.images[0] : '/assets/products/choker-ruby-01.jpg'" :alt="product.title" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy" />
                                            <template x-if="product.model_3d_url">
                                                <button type="button" @click="inspecting3D[product.id] = true" class="absolute bottom-2 left-2 inline-flex items-center gap-1 bg-gold-antique/90 hover:bg-gold-light text-oxblood-dark px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wider shadow-lg transition">
                                                    <x-heroicon-m-cube class="h-3.5 w-3.5" />
                                                    <span>Inspect 3D</span>
                                                </button>
                                            </template>
                                        </div>
                                    </template>
                                    <div class="absolute top-3 left-3 bg-oxblood-dark/90 border border-gold-antique/50 px-2 py-0.5 text-[10px] font-semibold tracking-widest text-gold-light uppercase backdrop-blur-sm">
                                        <span x-text="product.karat + ' Gold'"></span>
                                    </div>
                                    <div class="absolute bottom-2 right-2 bg-black/80 border border-gold-antique/30 px-2 py-0.5 text-[9px] font-mono text-ivory-base/90 backdrop-blur-sm">
                                        <span x-text="parseFloat(product.gross_weight_grams).toFixed(1) + 'g / ' + parseFloat(product.net_gold_weight_grams).toFixed(1) + 'g Net'"></span>
                                    </div>
                                </div>
                                <span class="text-[10px] font-medium tracking-[0.2em] uppercase text-gold-antique" x-text="product.category_name"></span>
                                <h3 class="mt-1 font-serif text-lg font-normal text-gold-light leading-snug line-clamp-2" x-text="product.title"></h3>
                                <p class="mt-1 text-xs text-ivory-base/70 line-clamp-2 font-light" x-text="product.stone_description"></p>
                            </div>

                            <div class="mt-5 border-t border-gold-antique/20 pt-4">
                                <div class="flex items-baseline justify-between mb-3">
                                    <span class="text-[10px] uppercase tracking-wider text-ivory-base/60">Sarafa Spot Value</span>
                                    <span class="font-serif text-lg font-semibold text-gold-light tracking-wide" x-text="formatPrice(product.pricing.total_price_pkr)"></span>
                                </div>
                                <button type="button" @click="openSpec(product)" class="w-full border border-gold-antique/60 bg-gold-antique/10 hover:bg-gold-antique hover:text-oxblood-dark py-2 text-xs font-semibold tracking-[0.2em] uppercase text-gold-light transition duration-200 text-center">View Valuation Slip</button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </section>
    <x-ui.product-spec-modal />
</x-layouts.app>
