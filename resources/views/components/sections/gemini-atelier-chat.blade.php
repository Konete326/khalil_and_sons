@php
    $pMethods = \App\Models\PaymentMethod::where('is_active', true)->get(); $r22k = \App\Models\GoldRate::where('karat', '22K')->first()?->rate_per_gram ?? 35365;
@endphp
<div
    x-data="{
        messages: [{ role: 'assistant', text: 'Assalamu Alaikum. I am your Master Goldsmith Concierge at Khalil & Sons. State your desired bridal suite, target weight in grams, or attach a sketch to calculate your transparent Saddar Sarafa valuation.' }],
        inputText: '', isTyping: false, imageFile: null, imagePreview: null,
        modelUrl: '{{ asset('assets/models/bridal-choker.glb') }}', isGenerating3D: false, progress3D: 100,
        quote: { karat: '22K', weight: 25, gold_rate: {{ $r22k }}, making: 37500, gems: 0, total: {{ round(25 * $r22k + 37500) }} },
        orderModal: false, orderSubmitted: false, orderData: { name: '', phone: '', email: '', notes: '', slip: null },
        createdOrder: null,
        async sendMessage(textToSend) {
            let msg = textToSend || this.inputText;
            if (!msg.trim() && !this.imageFile) return;
            this.messages.push({ role: 'user', text: msg, image: this.imagePreview });
            this.inputText = ''; this.isTyping = true;
            let fd = new FormData();
            fd.append('message', msg); fd.append('_token', '{{ csrf_token() }}');
            if (this.imageFile) fd.append('image', this.imageFile);
            this.messages.slice(-5).forEach((m, idx) => { fd.append(`history[${idx}][role]`, m.role); fd.append(`history[${idx}][content]`, m.text); });
            try {
                let res = await fetch('{{ route('atelier.chat') }}', { method: 'POST', body: fd });
                let data = await res.json();
                this.messages.push({ role: 'assistant', text: data.reply });
                if (data.estimate) {
                    this.quote.karat = data.estimate.karat || this.quote.karat;
                    this.quote.weight = data.estimate.weight_grams || this.quote.weight;
                    this.quote.making = data.estimate.making_charges || (this.quote.weight * 1500);
                    this.quote.total = data.estimate.total_pkr || (this.quote.weight * this.quote.gold_rate + this.quote.making);
                }
            } catch (e) { this.messages.push({ role: 'assistant', text: 'Saddar artisan desk connected. Please state your desired gold karat and target grams.' }); }
            finally { this.isTyping = false; this.imageFile = null; this.imagePreview = null; this.$nextTick(() => { let el = document.getElementById('chat-thread'); if(el) el.scrollTop = el.scrollHeight; }); }
        },
        async trigger3D() {
            this.isGenerating3D = true; this.progress3D = 25;
            let res = await fetch('{{ route('atelier.3d') }}', { method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' }, body: JSON.stringify({ prompt: this.quote.karat + ' gold bridal jewellery ' + this.quote.weight + 'g' }) });
            let data = await res.json();
            let p = setInterval(async () => {
                let pr = await (await fetch(`/api/atelier/poll-3d/${data.task_id}`)).json();
                this.progress3D = pr.progress || this.progress3D;
                if (pr.status === 'success' || pr.progress >= 100) { clearInterval(p); this.isGenerating3D = false; if (pr.model_url) this.modelUrl = pr.model_url; window.notify('3D Mesh ready.', 'success'); }
            }, 1200);
        },
        async submitOrder() {
            let fd = new FormData();
            fd.append('_token', '{{ csrf_token() }}'); fd.append('customer_name', this.orderData.name); fd.append('customer_phone', this.orderData.phone);
            fd.append('customer_email', this.orderData.email); fd.append('karat', this.quote.karat); fd.append('target_weight_grams', this.quote.weight);
            fd.append('estimated_budget', this.quote.total); fd.append('notes', this.orderData.notes); fd.append('model_3d_url', this.modelUrl);
            let res = await (await fetch('{{ route('atelier.order') }}', { method: 'POST', body: fd })).json();
            if (res.success) {
                this.createdOrder = res.order; this.orderSubmitted = true;
                if (this.orderData.slip) {
                    let sfd = new FormData(); sfd.append('_token', '{{ csrf_token() }}'); sfd.append('slip', this.orderData.slip);
                    await fetch(`/api/atelier/order/${res.tracking_code}/slip`, { method: 'POST', body: sfd });
                }
                window.location.href = `/track/${res.tracking_code}`;
            }
        }
    }"
    class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start"
>
    <div class="lg:col-span-7 flex flex-col h-[650px] border border-gold-antique/30 bg-oxblood-dark/90 shadow-2xl p-5">
        <div class="flex items-center justify-between border-b border-gold-antique/20 pb-3">
            <div class="flex items-center space-x-3">
                <span class="h-2.5 w-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                <div>
                    <h3 class="font-serif text-sm font-semibold text-gold-light uppercase tracking-wider">Gemini Atelier Goldsmith</h3>
                    <p class="text-[9px] text-gold-antique tracking-widest uppercase">Murshid Bazaar, Saddar Karachi • Live AI</p>
                </div>
            </div>
            <span class="text-[10px] font-mono text-ivory-base/60">22K: Rs. {{ number_format($r22k) }}/g</span>
        </div>

        <div class="flex items-center gap-2 py-2.5 border-b border-gold-antique/10 overflow-x-auto scrollbar-none text-[10px]">
            <button type="button" @click="sendMessage('I want to commission a 22K bridal choker necklace around 35 grams.')" class="px-2.5 py-1 border border-gold-antique/30 bg-oxblood/50 text-gold-light hover:bg-gold-antique hover:text-oxblood-dark transition flex-shrink-0">Bridal Choker 35g</button>
            <button type="button" @click="sendMessage('Estimate price for 21K solid gold bangles pair 40 grams plain karigari.')" class="px-2.5 py-1 border border-gold-antique/30 bg-oxblood/50 text-gold-light hover:bg-gold-antique hover:text-oxblood-dark transition flex-shrink-0">Plain Bangles 40g</button>
            <button type="button" @click="sendMessage('Quote for Mughal Polki ring with Basra pearls and uncut diamonds.')" class="px-2.5 py-1 border border-gold-antique/30 bg-oxblood/50 text-gold-light hover:bg-gold-antique hover:text-oxblood-dark transition flex-shrink-0">Polki Ring</button>
        </div>

        <div id="chat-thread" class="flex-1 overflow-y-auto space-y-3 p-3 text-xs leading-relaxed">
            <template x-for="(m, i) in messages" :key="i">
                <div :class="m.role === 'user' ? 'flex justify-end' : 'flex justify-start'">
                    <div :class="m.role === 'user' ? 'bg-gold-antique text-oxblood-dark font-medium' : 'bg-black/40 border border-gold-antique/20 text-ivory-base'" class="max-w-[85%] p-3.5 shadow-md">
                        <template x-if="m.image"><img :src="m.image" class="w-32 h-32 object-cover border border-gold-antique/40 mb-2" /></template>
                        <p class="whitespace-pre-line text-[11px]" x-text="m.text"></p>
                    </div>
                </div>
            </template>
            <div x-show="isTyping" class="text-gold-antique text-[10px] italic flex items-center gap-1.5"><span class="animate-pulse">●</span> Karigar consulting Sarafa ledger...</div>
        </div>

        <form @submit.prevent="sendMessage()" class="border-t border-gold-antique/20 pt-3 flex items-center gap-2">
            <label class="p-2 border border-gold-antique/30 text-gold-antique hover:text-gold-light cursor-pointer transition">
                <input type="file" accept="image/*" class="hidden" @change="handleImageUpload($event); sendMessage('Patron uploaded jewelry design sketch for Karigar evaluation.')" />
                <x-heroicon-o-paper-clip class="h-4 w-4" />
            </label>
            <input type="text" x-model="inputText" placeholder="Describe desired weight, karat, or stones..." class="flex-1 border border-gold-antique/30 bg-black/40 px-3 py-2 text-xs text-ivory-base focus:border-gold-antique focus:outline-none" />
            <button type="submit" class="bg-gold-antique px-4 py-2 text-xs font-semibold uppercase tracking-wider text-oxblood-dark hover:bg-gold-light transition">Send</button>
        </form>
    </div>

    <div class="lg:col-span-5 space-y-6">
        <div class="relative border border-gold-antique/30 bg-black/60 p-4 shadow-2xl">
            <div class="flex items-center justify-between border-b border-gold-antique/20 pb-2 mb-3">
                <span class="text-[11px] font-serif uppercase tracking-widest text-gold-light">Interactive 3D Atelier Mesh</span>
                <button type="button" @click="trigger3D()" :disabled="isGenerating3D" class="text-[10px] border border-gold-antique/50 px-2 py-0.5 text-gold-antique hover:bg-gold-antique hover:text-oxblood-dark transition">
                    <span x-text="isGenerating3D ? 'Generating ' + progress3D + '%' : 'Generate 3D Mesh'"></span>
                </button>
            </div>
            <div class="relative aspect-square w-full bg-gradient-to-b from-[#1b0303] to-black border border-gold-antique/20 overflow-hidden">
                <model-viewer :src="modelUrl" alt="3D Jewelry Mesh" auto-rotate camera-controls shadow-intensity="1" class="w-full h-full"></model-viewer>
                <div class="absolute bottom-2 left-2 right-2 bg-oxblood-dark/90 border border-gold-antique/30 px-2 py-1 text-[9px] text-center text-ivory-base/80">360° Drag to Rotate • Pinch to Inspect Settings</div>
            </div>
        </div>

        <div class="border border-gold-antique/30 bg-oxblood-dark/90 p-5 shadow-2xl font-mono text-xs text-ivory-base space-y-3">
            <div class="flex justify-between border-b border-gold-antique/20 pb-2"><span class="text-ivory-base/70">Karat & Weight</span><span class="text-gold-light font-bold" x-text="quote.karat + ' Gold • ' + quote.weight + 'g'"></span></div>
            <div class="flex justify-between border-b border-gold-antique/20 pb-2"><span class="text-ivory-base/70">Spot Gold Value</span><span x-text="'Rs. ' + Math.round(quote.weight * quote.gold_rate).toLocaleString()"></span></div>
            <div class="flex justify-between border-b border-gold-antique/20 pb-2"><span class="text-ivory-base/70">Karigar Making</span><span x-text="'Rs. ' + Math.round(quote.making).toLocaleString()"></span></div>
            <div class="flex justify-between items-baseline pt-2 border-t border-gold-antique/40"><span class="text-gold-antique font-sans uppercase tracking-wider font-semibold">Estimated Budget</span><span class="font-serif text-lg font-bold text-gold-light" x-text="'Rs. ' + Math.round(quote.total).toLocaleString()"></span></div>
            <button type="button" @click="orderModal = true" class="w-full bg-gold-antique py-3 text-xs font-semibold uppercase tracking-[0.2em] text-oxblood-dark hover:bg-gold-light transition shadow-xl mt-4">Lock Rate & Place Commission</button>
        </div>
    </div>

    <div x-show="orderModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/85 backdrop-blur-md">
        <div @click.outside="orderModal = false" class="w-full max-w-xl border border-gold-antique/50 bg-oxblood-dark p-6 shadow-2xl text-ivory-base max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between border-b border-gold-antique/30 pb-3 mb-4">
                <h4 class="font-serif text-base text-gold-light tracking-wide uppercase">Bespoke Order & Raast Payment</h4>
                <button type="button" @click="orderModal = false" class="text-ivory-base/60 hover:text-gold-light"><x-heroicon-m-x-mark class="h-6 w-6" /></button>
            </div>
            <div class="space-y-4 text-xs font-sans">
                <div class="border border-gold-antique/30 bg-black/40 p-3 space-y-2">
                    <p class="font-serif text-gold-antique text-sm">Corporate Settlement Details</p>
                    @foreach($pMethods as $pm)
                        <div class="border-b border-gold-antique/10 pb-1.5"><span class="font-semibold text-gold-light">{{ $pm->title }}:</span> {{ $pm->account_name }} • A/C: {{ $pm->account_number }} @if($pm->iban)<br><span class="text-[10px] text-ivory-base/70">IBAN: {{ $pm->iban }}</span>@endif</div>
                    @endforeach
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div><label class="block text-[10px] uppercase text-gold-antique mb-1">Full Name</label><input type="text" x-model="orderData.name" required class="w-full border border-gold-antique/30 bg-black/30 p-2 text-xs text-ivory-base" /></div>
                    <div><label class="block text-[10px] uppercase text-gold-antique mb-1">WhatsApp Phone</label><input type="text" x-model="orderData.phone" required class="w-full border border-gold-antique/30 bg-black/30 p-2 text-xs text-ivory-base" /></div>
                </div>
                <div><label class="block text-[10px] uppercase text-gold-antique mb-1">Email (Optional)</label><input type="email" x-model="orderData.email" class="w-full border border-gold-antique/30 bg-black/30 p-2 text-xs text-ivory-base" /></div>
                <div><label class="block text-[10px] uppercase text-gold-antique mb-1">Upload Transfer Receipt / Raast Slip</label><input type="file" @change="orderData.slip = $event.target.files[0]" class="w-full border border-gold-antique/30 bg-black/30 p-1.5 text-xs text-ivory-base" /></div>
                <button type="button" @click="submitOrder()" class="w-full bg-gold-antique py-3 text-xs font-semibold uppercase tracking-[0.2em] text-oxblood-dark hover:bg-gold-light transition shadow-xl mt-2">Generate Order & Verify Slip</button>
            </div>
        </div>
    </div>
</div>
