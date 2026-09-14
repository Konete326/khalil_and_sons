@php $pMethods = \App\Models\PaymentMethod::where('is_active', true)->get(); $r22k = \App\Models\GoldRate::where('karat', '22K')->first()?->rate_per_gram ?? 35365; @endphp
<div
    x-data="{
        messages: [{ role: 'assistant', text: 'Assalam-o-Alaikum! Welcome to Khalil & Son\'s Atelier. I am your Master Goldsmith concierge. Are you looking to craft a bridal set, customize a heritage kada, or design something entirely bespoke from an image?' }],
        inputText: '', isTyping: false, imageFile: null, imagePreview: null, show3D: false, modelUrl: '{{ asset('assets/models/bridal-choker.glb') }}',
        isGenerating3D: false, progress3D: 100, orderModal: false, orderData: { name: '', phone: '', email: '', notes: '', slip: null },
        quote: { karat: '22K', weight: 25, gold_rate: {{ $r22k }}, making: 37500, gems: 0, advance_lock: {{ round(25 * $r22k) }}, total: {{ round(25 * $r22k + 37500) }}, is_studded: true },
        handleImageUpload(e) {
            let f = e.target.files[0]; if (!f) return; this.imageFile = f;
            let r = new FileReader(); r.onload = (ev) => { this.imagePreview = ev.target.result; this.sendMessage('Patron uploaded jewelry reference design for Saddar Sarafa valuation.'); };
            r.readAsDataURL(f);
        },
        async sendMessage(textToSend) {
            let msg = textToSend || this.inputText; if (!msg.trim() && !this.imageFile) return;
            this.messages.push({ role: 'user', text: msg, image: this.imagePreview });
            this.inputText = ''; this.isTyping = true;
            let fd = new FormData(); fd.append('message', msg); fd.append('_token', '{{ csrf_token() }}');
            if (this.imageFile) fd.append('image', this.imageFile);
            this.messages.slice(-5).forEach((m, idx) => { fd.append(`history[${idx}][role]`, m.role); fd.append(`history[${idx}][content]`, m.text); });
            try {
                let res = await (await fetch('{{ route('atelier.chat') }}', { method: 'POST', body: fd, headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') } })).json();
                this.messages.push({ role: 'assistant', text: res.reply });
                if (res.estimate) {
                    this.quote.karat = res.estimate.karat || this.quote.karat; this.quote.weight = res.estimate.weight_grams || this.quote.weight;
                    this.quote.gold_rate = res.estimate.gold_rate || this.quote.gold_rate; this.quote.making = res.estimate.making_charges || (this.quote.weight * 1500);
                    this.quote.gems = res.estimate.gemstone_cost || 0; this.quote.advance_lock = res.estimate.advance_lock || (this.quote.weight * this.quote.gold_rate);
                    this.quote.total = res.estimate.total_pkr || (this.quote.weight * this.quote.gold_rate + this.quote.making + this.quote.gems);
                    this.quote.is_studded = res.estimate.is_studded ?? true;
                }
            } catch (e) {
                this.messages.push({ role: 'assistant', text: 'Karigar desk connected. State your desired karat, target weight in grams, or attach a sketch.' });
            } finally {
                this.isTyping = false; this.imageFile = null; this.imagePreview = null;
                this.$nextTick(() => { let el = document.getElementById('chat-thread'); if(el) el.scrollTop = el.scrollHeight; });
            }
        },
        async trigger3D() {
            this.isGenerating3D = true; this.progress3D = 20; this.show3D = true;
            let res = await (await fetch('{{ route('atelier.3d') }}', { method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') }, body: JSON.stringify({ prompt: this.quote.karat + ' gold bridal jewellery ' + this.quote.weight + 'g' }) })).json();
            let p = setInterval(async () => {
                let pr = await (await fetch(`/api/atelier/poll-3d/${res.task_id}`)).json();
                this.progress3D = pr.progress || this.progress3D;
                if (pr.status === 'success' || pr.progress >= 100) { clearInterval(p); this.isGenerating3D = false; if (pr.model_url) this.modelUrl = pr.model_url; window.notify('3D Mesh generated.', 'success'); }
            }, 1200);
        },
        async submitOrder() {
            let fd = new FormData(); fd.append('_token', '{{ csrf_token() }}'); fd.append('customer_name', this.orderData.name);
            fd.append('customer_phone', this.orderData.phone); fd.append('customer_email', this.orderData.email); fd.append('karat', this.quote.karat);
            fd.append('target_weight_grams', this.quote.weight); fd.append('estimated_budget', this.quote.total); fd.append('model_3d_url', this.modelUrl);
            let res = await (await fetch('{{ route('atelier.order') }}', { method: 'POST', body: fd, headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') } })).json();
            if (res.success) {
                if (this.orderData.slip) {
                    let sfd = new FormData(); sfd.append('_token', '{{ csrf_token() }}'); sfd.append('slip', this.orderData.slip);
                    await fetch(`/api/atelier/order/${res.tracking_code}/slip`, { method: 'POST', body: sfd, headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') } });
                }
                window.location.href = `/track/${res.tracking_code}`;
            }
        }
    }"
    class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start"
>
    <div class="lg:col-span-7 flex flex-col h-[670px] border border-gold-antique/30 bg-oxblood-dark/90 shadow-2xl p-5">
        <div class="flex items-center justify-between border-b border-gold-antique/20 pb-3">
            <div class="flex items-center space-x-3">
                <span class="h-2.5 w-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                <div>
                    <h3 class="font-serif text-sm font-semibold text-gold-light uppercase tracking-wider">Master Goldsmith Concierge</h3>
                    <p class="text-[9px] text-gold-antique tracking-widest uppercase">Murshid Bazaar Saddar • Sarafa AI Desk</p>
                </div>
            </div>
            <span class="text-[10px] font-mono text-ivory-base/60">22K: Rs. {{ number_format($r22k) }}/g</span>
        </div>
        <div class="py-2 border-b border-gold-antique/10 space-y-1 overflow-x-auto scrollbar-none text-[10px]">
            <div class="flex items-center gap-1.5 flex-nowrap">
                <span class="text-[9px] uppercase tracking-wider text-gold-antique/70 flex-shrink-0 font-mono">Category:</span>
                <button type="button" @click="sendMessage('I want to commission a bespoke Bridal Choker suite.')" class="px-2 py-0.5 border border-gold-antique/30 bg-oxblood/60 text-gold-light hover:bg-gold-antique hover:text-oxblood-dark transition flex-shrink-0">Bridal Choker</button>
                <button type="button" @click="sendMessage('I want to customize a handcrafted Polki Kada pair.')" class="px-2 py-0.5 border border-gold-antique/30 bg-oxblood/60 text-gold-light hover:bg-gold-antique hover:text-oxblood-dark transition flex-shrink-0">Polki Kada</button>
                <button type="button" @click="sendMessage('I want to design a royal Cocktail Ring with uncut stones.')" class="px-2 py-0.5 border border-gold-antique/30 bg-oxblood/60 text-gold-light hover:bg-gold-antique hover:text-oxblood-dark transition flex-shrink-0">Cocktail Ring</button>
                <button type="button" @click="sendMessage('I would like to commission Heritage Jhumkas in traditional filigree.')" class="px-2 py-0.5 border border-gold-antique/30 bg-oxblood/60 text-gold-light hover:bg-gold-antique hover:text-oxblood-dark transition flex-shrink-0">Heritage Jhumkas</button>
            </div>
            <div class="flex items-center gap-1.5 flex-nowrap">
                <span class="text-[9px] uppercase tracking-wider text-gold-antique/70 flex-shrink-0 font-mono">Spec & Rate:</span>
                <button type="button" @click="sendMessage('I prefer 22K Solid Gold with today\'s Sarafa rate.')" class="px-2 py-0.5 border border-gold-antique/30 bg-black/40 text-gold-antique hover:bg-gold-antique hover:text-oxblood-dark transition flex-shrink-0">22K Solid Gold</button>
                <button type="button" @click="sendMessage('I prefer 21K Traditional gold for this bespoke piece.')" class="px-2 py-0.5 border border-gold-antique/30 bg-black/40 text-gold-antique hover:bg-gold-antique hover:text-oxblood-dark transition flex-shrink-0">21K Traditional</button>
                <button type="button" @click="sendMessage('I want 18K gold setting suitable for diamonds.')" class="px-2 py-0.5 border border-gold-antique/30 bg-black/40 text-gold-antique hover:bg-gold-antique hover:text-oxblood-dark transition flex-shrink-0">18K Diamond Setting</button>
                <button type="button" @click="sendMessage('My target weight range is under 30 Grams.')" class="px-2 py-0.5 border border-gold-antique/30 bg-black/40 text-gold-antique hover:bg-gold-antique hover:text-oxblood-dark transition flex-shrink-0">Under 30 Grams</button>
                <button type="button" @click="sendMessage('My target weight range is 30-60 Grams.')" class="px-2 py-0.5 border border-gold-antique/30 bg-black/40 text-gold-antique hover:bg-gold-antique hover:text-oxblood-dark transition flex-shrink-0">30-60 Grams</button>
                <button type="button" @click="sendMessage('I have my own gold bullion/jewelry for casting.')" class="px-2 py-0.5 border border-gold-antique/30 bg-black/40 text-gold-antique hover:bg-gold-antique hover:text-oxblood-dark transition flex-shrink-0">I have my own gold</button>
                <button type="button" @click="sendMessage('I wish to lock today\'s 22K Sarafa spot bullion rate for my order.')" class="px-2 py-0.5 border border-gold-antique bg-gold-antique/20 text-gold-light hover:bg-gold-antique hover:text-oxblood-dark transition flex-shrink-0 font-semibold">Lock Today's 22K Sarafa Rate</button>
            </div>
        </div>
        <div id="chat-thread" class="flex-1 overflow-y-auto space-y-3 p-3 text-xs leading-relaxed">
            <template x-for="(m, i) in messages" :key="i">
                <div :class="m.role === 'user' ? 'flex justify-end' : 'flex justify-start'">
                    <div :class="m.role === 'user' ? 'bg-gold-antique text-oxblood-dark font-medium' : 'bg-black/40 border border-gold-antique/20 text-ivory-base'" class="max-w-[85%] p-3.5 shadow-md">
                        <template x-if="m.image"><img :src="m.image" class="w-32 h-32 object-cover border border-gold-antique/40 mb-2 shadow" /></template>
                        <p class="whitespace-pre-line text-[11px]" x-text="m.text"></p>
                    </div>
                </div>
            </template>
            <div x-show="isTyping" class="text-gold-antique text-[10px] italic flex items-center gap-1.5"><span class="animate-pulse">●</span> Karigar consulting Sarafa ledger & calculating valuation...</div>
        </div>
        <form @submit.prevent="sendMessage()" class="border-t border-gold-antique/20 pt-3 flex items-center gap-2">
            <label class="p-2 border border-gold-antique/30 text-gold-antique hover:text-gold-light cursor-pointer transition">
                <input type="file" accept="image/*" class="hidden" @change="handleImageUpload($event)" />
                <x-heroicon-o-paper-clip class="h-4 w-4" />
            </label>
            <input type="text" x-model="inputText" placeholder="Describe desired weight, stones, or upload design sketch..." class="flex-1 border border-gold-antique/30 bg-black/40 px-3 py-2 text-xs text-ivory-base focus:border-gold-antique focus:outline-none" />
            <button type="submit" class="bg-gold-antique px-4 py-2 text-xs font-semibold uppercase tracking-wider text-oxblood-dark hover:bg-gold-light transition">Send</button>
        </form>
    </div>
    <div class="lg:col-span-5 space-y-6">
        <div class="relative border border-gold-antique/30 bg-black/60 p-4 shadow-2xl">
            <div class="flex items-center justify-between border-b border-gold-antique/20 pb-2 mb-3">
                <span class="text-[11px] font-serif uppercase tracking-widest text-gold-light">22K Solid Gold 3D Atelier Studio</span>
                <button type="button" @click="trigger3D()" :disabled="isGenerating3D" class="text-[10px] border border-gold-antique/50 px-2 py-0.5 text-gold-antique hover:bg-gold-antique hover:text-oxblood-dark transition">
                    <span x-text="isGenerating3D ? 'Generating 3D ' + progress3D + '%' : 'Generate Custom 3D'"></span>
                </button>
            </div>
            <div class="relative aspect-square w-full bg-gradient-to-b from-[#1b0303] to-black border border-gold-antique/20 overflow-hidden">
                <div x-show="!show3D" class="relative w-full h-full">
                    <img src="{{ asset('assets/products/choker-ruby-01.jpg') }}" alt="22K Solid Gold Bridal Choker" class="w-full h-full object-cover" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-black/30 flex flex-col justify-between p-4">
                        <span class="self-start text-[9px] uppercase tracking-widest font-mono bg-oxblood-dark/90 border border-gold-antique/40 px-2 py-0.5 text-gold-light">22K PBR Hallmark Specimen • Ruby Accents</span>
                        <button type="button" @click="show3D = true" class="w-full bg-gold-antique/90 hover:bg-gold-light text-oxblood-dark font-semibold text-xs py-2.5 uppercase tracking-widest transition shadow-2xl border border-gold-light/40">Inspect in Interactive 3D</button>
                    </div>
                </div>
                <div x-show="show3D" class="w-full h-full relative" x-cloak>
                    <template x-if="show3D">
                        <model-viewer :src="modelUrl" alt="22K Solid Gold Bridal Choker with Burmese Rubies" auto-rotate camera-controls shadow-intensity="1.5" exposure="1.2" environment-image="neutral" class="w-full h-full"></model-viewer>
                    </template>
                    <button type="button" @click="show3D = false" class="absolute top-2 right-2 bg-black/70 border border-gold-antique/40 text-[9px] px-2 py-1 text-gold-antique hover:text-gold-light">High-Res Render</button>
                    <div class="absolute bottom-2 left-2 right-2 bg-oxblood-dark/90 border border-gold-antique/30 px-2 py-1 text-[9px] text-center text-ivory-base/80">360° Drag to Rotate • Pinch to Zoom Setting</div>
                </div>
            </div>
        </div>
        <div class="border border-gold-antique/30 bg-oxblood-dark/90 p-5 shadow-2xl font-mono text-xs text-ivory-base space-y-2">
            <div class="flex justify-between border-b border-gold-antique/20 pb-1.5"><span class="text-ivory-base/70">Karat & Weight</span><span class="text-gold-light font-bold" x-text="quote.karat + ' Gold • ' + quote.weight + 'g'"></span></div>
            <div class="flex justify-between border-b border-gold-antique/20 pb-1.5"><span class="text-ivory-base/70">Sarafa Spot Gold</span><span x-text="'Rs. ' + Math.round(quote.weight * quote.gold_rate).toLocaleString()"></span></div>
            <div class="flex justify-between border-b border-gold-antique/20 pb-1.5"><span class="text-ivory-base/70" x-text="quote.is_studded ? 'Karigar Making (Studded Rs. 1,500/g)' : 'Karigar Making (Plain Rs. 1,000/g)'"></span><span x-text="'Rs. ' + Math.round(quote.making).toLocaleString()"></span></div>
            <div class="flex justify-between border-b border-gold-antique/20 pb-1.5"><span class="text-ivory-base/70">Precious Stones Allowance</span><span x-text="'Rs. ' + Math.round(quote.gems).toLocaleString()"></span></div>
            <div class="flex justify-between border-b border-gold-antique/20 pb-1.5 bg-black/30 px-2 py-1 text-gold-antique"><span class="text-[10px] uppercase">Advance Gold Lock (100% Spot)</span><span class="font-bold text-gold-light" x-text="'Rs. ' + Math.round(quote.advance_lock || (quote.weight * quote.gold_rate)).toLocaleString()"></span></div>
            <div class="flex justify-between items-baseline pt-2 border-t border-gold-antique/40"><span class="text-gold-antique font-sans uppercase tracking-wider font-semibold">Estimated Budget</span><span class="font-serif text-lg font-bold text-gold-light" x-text="'Rs. ' + Math.round(quote.total).toLocaleString()"></span></div>
            <button type="button" @click="orderModal = true" class="w-full bg-gold-antique py-3 text-xs font-semibold uppercase tracking-[0.2em] text-oxblood-dark hover:bg-gold-light transition shadow-xl mt-3">Initiate Token & Book</button>
        </div>
    </div>
    <x-sections.atelier-order-modal :payment-methods="$pMethods" />
</div>
