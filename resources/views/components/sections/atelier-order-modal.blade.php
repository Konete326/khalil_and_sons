@props(['paymentMethods'])
<div x-show="orderModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/85 backdrop-blur-md">
    <div @click.outside="orderModal = false" class="w-full max-w-xl border border-gold-antique/50 bg-oxblood-dark p-6 shadow-2xl text-ivory-base max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between border-b border-gold-antique/30 pb-3 mb-4">
            <div>
                <h4 class="font-serif text-base text-gold-light tracking-wide uppercase">Initiate Bespoke Booking & Token</h4>
                <p class="text-[10px] text-gold-antique/80">Saddar Atelier Official Gold Rate Lock Confirmation</p>
            </div>
            <button type="button" @click="orderModal = false" class="text-ivory-base/60 hover:text-gold-light"><x-heroicon-m-x-mark class="h-6 w-6" /></button>
        </div>
        <div class="space-y-4 text-xs font-sans">
            <div class="border border-gold-antique/30 bg-black/40 p-3 space-y-2">
                <div class="flex justify-between items-center text-[11px] font-mono">
                    <span class="text-gold-antique">100% Bullion Lock Amount:</span>
                    <span class="text-gold-light font-bold" x-text="'Rs. ' + Math.round(quote.advance_lock || (quote.weight * quote.gold_rate)).toLocaleString()"></span>
                </div>
                <div class="text-[10px] text-ivory-base/60 leading-relaxed border-t border-gold-antique/10 pt-1.5">
                    Settlement Options (Raast / IBAN / SWIFT / Wise)
                </div>
                @foreach($paymentMethods as $pm)
                    <div class="border-b border-gold-antique/10 pb-1 text-[11px]"><span class="font-semibold text-gold-light">{{ $pm->title }}:</span> {{ $pm->account_name }} • {{ $pm->account_number }} @if($pm->iban)<br><span class="text-[9px] text-ivory-base/70">IBAN: {{ $pm->iban }}</span>@endif</div>
                @endforeach
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div><label class="block text-[10px] uppercase text-gold-antique mb-1">Full Name</label><input type="text" x-model="orderData.name" required class="w-full border border-gold-antique/30 bg-black/30 p-2 text-xs text-ivory-base focus:border-gold-antique focus:outline-none" /></div>
                <div><label class="block text-[10px] uppercase text-gold-antique mb-1">WhatsApp Phone</label><input type="text" x-model="orderData.phone" required class="w-full border border-gold-antique/30 bg-black/30 p-2 text-xs text-ivory-base focus:border-gold-antique focus:outline-none" /></div>
            </div>
            <div><label class="block text-[10px] uppercase text-gold-antique mb-1">Email (Optional)</label><input type="email" x-model="orderData.email" class="w-full border border-gold-antique/30 bg-black/30 p-2 text-xs text-ivory-base focus:border-gold-antique focus:outline-none" /></div>
            <div><label class="block text-[10px] uppercase text-gold-antique mb-1">Upload Transfer Slip / Deposit Screenshot</label><input type="file" @change="orderData.slip = $event.target.files[0]" class="w-full border border-gold-antique/30 bg-black/30 p-1.5 text-xs text-ivory-base" /></div>
            <button type="button" @click="submitOrder()" class="w-full bg-gold-antique py-3 text-xs font-semibold uppercase tracking-[0.2em] text-oxblood-dark hover:bg-gold-light transition shadow-xl mt-2">Submit Commission & Lock Rate</button>
        </div>
    </div>
</div>
