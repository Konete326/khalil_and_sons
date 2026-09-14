@props(['categories' => null, 'products' => null, 'currency' => null])
@php
    $categories = $categories ?? \App\Models\Category::orderBy('sort_order')->get();
    $currencies = \App\Models\Currency::where('is_active', true)->get();
    $pricingService = app(\App\Services\JewelleryPricingService::class);
    $rawProducts = $products ?? \App\Models\Product::with('category')->where('is_active', true)->get();
    $productsData = $rawProducts->map(function ($p) use ($pricingService) {
        $data = is_array($p) ? $p : $p->toArray();
        $data['pricing'] = $data['pricing'] ?? $pricingService->calculatePrice($p);
        $data['category_slug'] = is_array($p) ? ($p['category_slug'] ?? '') : ($p->category?->slug ?? '');
        return $data;
    });
    $currRates = $currencies->pluck('exchange_rate_to_pkr', 'code');
    $currSymbols = $currencies->pluck('symbol', 'code');
@endphp

<div
    x-data="{
        activeTab: 'all',
        currency: 'PKR',
        currencies: {{ Js::from($currRates) }},
        symbols: {{ Js::from($currSymbols) }},
        products: {{ Js::from($productsData) }},
        formatPrice(totalPkr) {
            let rate = parseFloat(this.currencies[this.currency] || 1);
            let sym = this.symbols[this.currency] || 'Rs.';
            if (this.currency === 'PKR') {
                return sym + ' ' + Math.round(totalPkr).toLocaleString('en-US');
            }
            let converted = (totalPkr / rate).toFixed(2);
            return sym + ' ' + parseFloat(converted).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        },
        filteredProducts() {
            if (this.activeTab === 'all') return this.products;
            return this.products.filter(p => p.category_slug === this.activeTab);
        },
        openSpec(product) {
            $dispatch('open-product-spec', { product, currency: this.currency });
        }
    }"
    @currency-change.window="currency = $event.detail"
    class="w-full"
>
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 border-b border-gold-antique/20 pb-6 mb-10">
        <div class="flex items-center gap-2 overflow-x-auto max-w-full pb-2 sm:pb-0 scrollbar-none text-xs">
            <button
                type="button"
                @click="activeTab = 'all'"
                :class="activeTab === 'all' ? 'bg-gold-antique text-oxblood-dark font-semibold' : 'text-ivory-base/80 hover:text-gold-light border border-gold-antique/30 bg-oxblood-dark/40'"
                class="px-4 py-2 uppercase tracking-widest transition flex-shrink-0"
            >
                All
            </button>
            @foreach($categories as $cat)
                <button
                    type="button"
                    @click="activeTab = '{{ $cat->slug }}'"
                    :class="activeTab === '{{ $cat->slug }}' ? 'bg-gold-antique text-oxblood-dark font-semibold' : 'text-ivory-base/80 hover:text-gold-light border border-gold-antique/30 bg-oxblood-dark/40'"
                    class="px-4 py-2 uppercase tracking-widest transition flex-shrink-0"
                >
                    {{ $cat->name }}
                </button>
            @endforeach
        </div>

        <div class="flex items-center gap-3">
            <span class="text-[11px] uppercase tracking-widest text-gold-antique">Currency:</span>
            <div class="inline-flex border border-gold-antique/40 bg-oxblood-dark/80 p-0.5">
                <template x-for="c in ['PKR', 'USD', 'AED', 'SAR', 'GBP']" :key="c">
                    <button
                        type="button"
                        @click="currency = c; $dispatch('currency-change', c)"
                        :class="currency === c ? 'bg-gold-antique text-oxblood-dark font-bold' : 'text-ivory-base/70 hover:text-gold-light'"
                        class="px-2.5 py-1 text-[10px] uppercase tracking-wider transition"
                        x-text="c"
                    ></button>
                </template>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
        <template x-for="product in filteredProducts()" :key="product.id">
            <div class="group relative flex flex-col justify-between border border-gold-antique/30 bg-oxblood-dark/70 backdrop-blur-md p-5 shadow-2xl transition-all duration-300 hover:-translate-y-1.5 hover:border-gold-antique">
                <div>
                    <div class="relative aspect-square w-full overflow-hidden bg-black/40 border border-gold-antique/20 mb-4">
                        <img
                            :src="product.images && product.images[0] ? product.images[0] : '/assets/products/choker-ruby-01.jpg'"
                            :alt="product.title"
                            class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105"
                            loading="lazy"
                        />
                        <div class="absolute top-3 left-3 bg-oxblood-dark/90 border border-gold-antique/50 px-2.5 py-0.5 text-[10px] font-semibold tracking-widest text-gold-light uppercase backdrop-blur-sm">
                            <span x-text="product.karat + ' Gold'"></span>
                        </div>
                        <div class="absolute bottom-3 right-3 bg-black/80 border border-gold-antique/30 px-2 py-0.5 text-[10px] font-mono text-ivory-base/90 backdrop-blur-sm">
                            <span x-text="'Gross: ' + parseFloat(product.gross_weight_grams).toFixed(1) + 'g | Net: ' + parseFloat(product.net_gold_weight_grams).toFixed(1) + 'g'"></span>
                        </div>
                    </div>

                    <span class="text-[10px] font-medium tracking-[0.2em] uppercase text-gold-antique" x-text="product.category ? product.category.name : 'Masterpiece'"></span>
                    <h3 class="mt-1 font-serif text-lg font-normal text-gold-light leading-snug line-clamp-2" x-text="product.title"></h3>
                    <p class="mt-2 text-xs text-ivory-base/70 line-clamp-2 font-light" x-text="product.stone_description"></p>
                </div>

                <div class="mt-6 border-t border-gold-antique/20 pt-4">
                    <div class="flex items-baseline justify-between mb-3">
                        <span class="text-[10px] uppercase tracking-wider text-ivory-base/60">Live Sarafa Price</span>
                        <span class="font-serif text-lg font-semibold text-gold-light tracking-wide" x-text="formatPrice(product.pricing.total_price_pkr)"></span>
                    </div>

                    <button
                        type="button"
                        @click="openSpec(product)"
                        class="w-full border border-gold-antique/60 bg-gold-antique/10 hover:bg-gold-antique hover:text-oxblood-dark py-2.5 text-xs font-semibold tracking-[0.2em] uppercase text-gold-light transition duration-200 text-center"
                    >
                        View Specification
                    </button>
                </div>
            </div>
        </template>
    </div>

    <template x-if="filteredProducts().length === 0">
        <div class="border border-gold-antique/20 bg-oxblood-dark/50 p-12 text-center text-ivory-base/70 font-sans">
            <p class="font-serif text-lg text-gold-light">No pieces currently available in this category</p>
            <p class="mt-2 text-xs text-ivory-base/60">Our master craftsmen can create a bespoke piece according to your specifications.</p>
        </div>
    </template>
</div>
