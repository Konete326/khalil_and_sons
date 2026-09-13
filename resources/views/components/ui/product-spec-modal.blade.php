<div
    x-data="{
        isOpen: false,
        product: null,
        currency: 'PKR',
        calc: {},
        initModal(detail) {
            this.product = detail.product;
            this.currency = detail.currency || 'PKR';
            this.calc = detail.product.pricing || {};
            this.isOpen = true;
            document.body.classList.add('overflow-hidden');
        },
        closeModal() {
            this.isOpen = false;
            document.body.classList.remove('overflow-hidden');
        },
        format(amount) {
            let rate = parseFloat(this.calc.exchange_rate || 1);
            let sym = this.currency === 'PKR' ? 'Rs.' : (this.currency === 'USD' ? '$' : (this.currency === 'GBP' ? '£' : this.currency));
            if (this.currency === 'PKR') return 'Rs. ' + Math.round(amount).toLocaleString('en-US');
            return sym + ' ' + (amount / rate).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        },
        getWhatsAppLink() {
            if (!this.product) return '#';
            let title = encodeURIComponent(this.product.title);
            let karat = encodeURIComponent(this.product.karat);
            let gross = this.product.gross_weight_grams;
            let net = this.product.net_gold_weight_grams;
            let price = encodeURIComponent(this.format(this.calc.total_price_pkr));
            let msg = `Assalam-o-Alaikum Khalil & Sons Concierge, I would like to inquire about the ${title} (${karat}, Gross: ${gross}g, Net: ${net}g). Quoted Sarafa Price: ${price}. Please confirm availability and spot rate lock.`;
            return 'https://wa.me/923001234567?text=' + encodeURIComponent(msg);
        }
    }"
    @open-product-spec.window="initModal($event.detail)"
    @keydown.escape.window="if (isOpen) closeModal()"
    x-show="isOpen"
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 lg:p-8"
>
    <div
        x-show="isOpen"
        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        @click="closeModal()"
        class="fixed inset-0 bg-black/85 backdrop-blur-md"
    ></div>

    <div
        x-show="isOpen"
        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 scale-100" x-transition:leave-end="opacity-0 translate-y-4 scale-95"
        class="relative w-full max-w-4xl overflow-hidden border border-gold-antique/50 bg-oxblood-dark text-ivory-base shadow-2xl z-10 max-h-[92vh] flex flex-col"
    >
        <div class="flex items-center justify-between border-b border-gold-antique/30 px-6 py-4 bg-[#230404]">
            <div class="flex items-center space-x-3">
                <span class="h-2 w-2 rounded-full bg-gold-antique animate-pulse"></span>
                <span class="font-serif text-xs font-semibold tracking-[0.25em] text-gold-light uppercase">Saddar Sarafa Transparent Pricing Slip</span>
            </div>
            <button type="button" @click="closeModal()" class="text-ivory-base/70 hover:text-gold-light p-1 transition" aria-label="Close">
                <x-heroicon-m-x-mark class="h-6 w-6" />
            </button>
        </div>

        <div class="overflow-y-auto p-6 space-y-6 flex-1 text-xs">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                <div class="md:col-span-5 flex flex-col justify-between">
                    <div class="relative aspect-square w-full overflow-hidden border border-gold-antique/30 bg-black/50">
                        <img
                            :src="product && product.images && product.images[0] ? product.images[0] : '/assets/products/choker-ruby-01.jpg'"
                            :alt="product ? product.title : ''"
                            class="h-full w-full object-cover"
                        />
                        <div class="absolute bottom-2 left-2 right-2 bg-oxblood-dark/90 border border-gold-antique/30 p-2 text-[10px] text-center text-gold-antique">
                            <span>Interactive 3D Atelier & High-Res Inspection</span>
                        </div>
                    </div>
                    <div class="mt-4 p-3 border border-gold-antique/20 bg-white/5">
                        <h4 class="font-serif text-sm text-gold-light" x-text="product ? product.title : ''"></h4>
                        <p class="mt-1 text-[11px] text-ivory-base/80 leading-relaxed" x-text="product ? product.stone_description : ''"></p>
                    </div>
                </div>

                <div class="md:col-span-7 flex flex-col justify-between bg-black/30 border border-gold-antique/20 p-4 sm:p-5">
                    <div class="space-y-3 font-mono">
                        <div class="flex justify-between border-b border-gold-antique/20 pb-2">
                            <span class="text-ivory-base/70">Sarafa Rate (<span x-text="calc.karat || '22K'"></span> Gold)</span>
                            <span class="text-gold-light font-bold" x-text="'Rs. ' + Math.round(calc.rate_per_gram || 0).toLocaleString() + ' / g (Rs. ' + Math.round(calc.rate_per_tola || 0).toLocaleString() + '/tola)'"></span>
                        </div>
                        <div class="flex justify-between border-b border-gold-antique/20 pb-2">
                            <span class="text-ivory-base/70">Gross vs Net Gold Weight</span>
                            <span class="text-ivory-base font-semibold" x-text="(calc.gross_weight_grams || 0) + 'g gross / ' + (calc.net_gold_weight_grams || 0) + 'g net gold'"></span>
                        </div>
                        <div class="flex justify-between border-b border-gold-antique/20 pb-2">
                            <span class="text-ivory-base/70">Net Gold Value</span>
                            <span class="text-ivory-base font-semibold" x-text="'Rs. ' + Math.round(calc.gold_cost_pkr || 0).toLocaleString()"></span>
                        </div>
                        <div class="flex justify-between border-b border-gold-antique/20 pb-2">
                            <span class="text-ivory-base/70">Karigar Making Charges</span>
                            <span class="text-ivory-base font-semibold" x-text="'Rs. ' + (calc.making_rate_per_gram || 1500) + '/g → Rs. ' + Math.round(calc.making_charges_pkr || 0).toLocaleString()"></span>
                        </div>
                        <div class="flex justify-between border-b border-gold-antique/20 pb-2">
                            <span class="text-ivory-base/70">Gemstone Value & Setting</span>
                            <span class="text-ivory-base font-semibold" x-text="'Rs. ' + Math.round(calc.gemstone_cost_pkr || 0).toLocaleString()"></span>
                        </div>
                        <div class="flex justify-between items-baseline pt-2 text-sm border-t border-gold-antique/40">
                            <span class="text-gold-antique uppercase tracking-wider font-sans font-semibold">Total Price (<span x-text="currency"></span>)</span>
                            <span class="font-serif text-xl font-bold text-gold-light" x-text="format(calc.total_price_pkr)"></span>
                        </div>
                    </div>

                    <div class="mt-4 space-y-2 border-t border-gold-antique/20 pt-3 text-[10px] text-ivory-base/75 leading-relaxed">
                        <p class="flex items-start gap-1.5">
                            <span class="text-gold-antique font-bold">★</span>
                            <span><strong>1.5mm Stone Standard:</strong> Stones &le; 1.5mm stay within gold weight; stones &gt; 1.5mm are deducted and billed separately.</span>
                        </p>
                        <p class="flex items-start gap-1.5">
                            <span class="text-gold-antique font-bold">★</span>
                            <span><strong>100% Advance Gold Lock Policy:</strong> Spot gold value is fixed at Karachi Sarafa Murshid Bazaar rate upon booking.</span>
                        </p>
                    </div>

                    <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-3 font-sans">
                        <a
                            :href="getWhatsAppLink()"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="flex items-center justify-center gap-2 bg-[#25D366] hover:bg-[#20bd5a] text-black font-semibold uppercase tracking-wider px-4 py-3 text-xs transition shadow-lg"
                        >
                            <span>WhatsApp Concierge</span>
                        </a>
                        <button
                            type="button"
                            @click="closeModal(); window.customConfirm('Would you like our master goldsmiths in Murshid Bazaar to tailor this design for you?', () => window.notify('Custom inquiry logged. Our artisan team will contact you.', 'success'), 'Custom Modification Inquiry')"
                            class="border border-gold-antique bg-gold-antique/20 hover:bg-gold-antique hover:text-oxblood-dark text-gold-light font-semibold uppercase tracking-wider px-4 py-3 text-xs transition"
                        >
                            Custom Modification
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
