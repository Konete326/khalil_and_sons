<x-layouts.admin :title="'Commission Inspection: ' . $order->tracking_code . ' | Khalil & Sons'">
    <div class="space-y-6 w-full" x-data="{ zoomModal: false, rejectModal: false }">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-gold-antique/20 pb-4">
            <div>
                <a href="{{ route('admin.orders.index') }}" class="text-xs text-gold-antique hover:text-gold-light underline font-mono">&larr; Return to Orders</a>
                <h2 class="font-mono text-2xl sm:text-3xl text-gold-light font-bold mt-1">{{ $order->tracking_code }}</h2>
                <p class="text-xs text-ivory-base/70 font-sans">Placed: {{ $order->created_at->format('M d, Y H:i') }} • Patron: {{ $order->customer_name }}</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('track', ['code' => $order->tracking_code]) }}" target="_blank" class="border border-gold-antique/40 px-3.5 py-2 text-xs font-mono text-gold-light hover:bg-gold-antique hover:text-oxblood-dark transition rounded">Customer View</a>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->customer_phone) }}?text={{ urlencode('Assalam-o-Alaikum ' . $order->customer_name . ', regarding your bespoke order ' . $order->tracking_code) }}" target="_blank" class="border border-[#25D366]/60 bg-[#25D366]/10 px-3.5 py-2 text-xs text-[#25D366] hover:bg-[#25D366] hover:text-black transition rounded">WhatsApp Patron</a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="bg-[#121212] border border-gold-antique/20 rounded-lg p-5 space-y-4 shadow-xl text-xs font-mono">
                <h3 class="font-serif text-sm text-gold-light uppercase tracking-wider font-sans border-b border-gold-antique/20 pb-2">Patron Specification</h3>
                <div class="space-y-2">
                    <div class="flex justify-between"><span class="text-ivory-base/60">Customer:</span><span class="text-ivory-base font-semibold">{{ $order->customer_name }}</span></div>
                    <div class="flex justify-between"><span class="text-ivory-base/60">Phone:</span><span>{{ $order->customer_phone }}</span></div>
                    <div class="flex justify-between"><span class="text-ivory-base/60">Email:</span><span>{{ $order->customer_email ?: 'N/A' }}</span></div>
                    <div class="flex justify-between border-t border-gold-antique/10 pt-2"><span class="text-ivory-base/60">Karat Standard:</span><span class="text-gold-light font-bold">{{ $order->karat }}</span></div>
                    <div class="flex justify-between"><span class="text-ivory-base/60">Target Weight:</span><span>{{ $order->target_weight_grams }}g</span></div>
                    <div class="flex justify-between border-t border-gold-antique/10 pt-2"><span class="text-ivory-base/60">Total Estimated:</span><span class="text-gold-light font-bold text-sm">Rs. {{ number_format($order->estimated_budget) }}</span></div>
                </div>
                @if($order->notes)
                    <div class="p-3 border border-gold-antique/15 bg-black/40 text-[11px] text-ivory-base/80 rounded">
                        <span class="text-gold-antique font-sans uppercase text-[9px] block mb-1">Patron Notes / Ledger:</span>
                        {{ $order->notes }}
                    </div>
                @endif
                <div class="border-t border-gold-antique/20 pt-3">
                    <span class="text-[10px] uppercase text-gold-antique block mb-1">Design Sketch Reference</span>
                    <img src="{{ asset($order->original_image_path) }}" alt="Design Reference" class="w-full aspect-square object-cover border border-gold-antique/30 bg-black/50 rounded" />
                </div>
            </div>

            <div class="bg-[#121212] border border-gold-antique/20 rounded-lg p-5 space-y-4 shadow-xl text-xs font-mono">
                <div class="flex items-center justify-between border-b border-gold-antique/20 pb-2">
                    <h3 class="font-serif text-sm text-gold-light uppercase tracking-wider font-sans">Payment Receipt</h3>
                    <span class="text-[10px] uppercase px-2 py-0.5 rounded {{ $order->payment_status === 'verified' ? 'bg-emerald-950 text-emerald-300' : ($order->payment_status === 'slip_uploaded' ? 'bg-amber-950 text-amber-300 animate-pulse' : 'bg-black/50 text-ivory-base/60') }}">{{ $order->payment_status }}</span>
                </div>
                @if($order->payment_slip_path)
                    <div class="relative cursor-pointer group" @click="zoomModal = true">
                        <img src="{{ route('admin.orders.slip', $order) }}" alt="Customer Slip" class="w-full aspect-[3/4] object-cover border border-gold-antique/40 shadow-inner rounded" />
                        <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 flex items-center justify-center text-gold-light transition text-xs font-sans rounded">Click to Zoom Lightbox</div>
                    </div>
                    <div class="flex gap-2 pt-2">
                        <form action="{{ route('admin.orders.payment', $order) }}" method="POST" class="flex-1">
                            @csrf
                            <input type="hidden" name="action" value="verify" />
                            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 py-2.5 text-xs font-semibold uppercase text-black transition rounded">Verify Slip</button>
                        </form>
                        <button type="button" @click="rejectModal = true" class="flex-1 border border-red-500/60 bg-red-950/40 hover:bg-red-900 py-2.5 text-xs font-semibold uppercase text-red-300 transition rounded">Reject</button>
                    </div>
                @else
                    <div class="py-12 text-center text-ivory-base/50 border border-dashed border-gold-antique/20 p-4 rounded">
                        <x-heroicon-o-document-magnifying-glass class="h-8 w-8 mx-auto text-gold-antique/40 mb-2" />
                        <span>No transfer slip uploaded yet by patron.</span>
                    </div>
                @endif
            </div>

            <div class="bg-[#121212] border border-gold-antique/20 rounded-lg p-5 space-y-4 shadow-xl text-xs font-mono">
                <h3 class="font-serif text-sm text-gold-light uppercase tracking-wider font-sans border-b border-gold-antique/20 pb-2">Workshop Stage Control</h3>
                <div class="space-y-2 text-xs">
                    <p class="text-ivory-base/70">Current Manufacturing Stage:</p>
                    <div class="p-3 border border-gold-antique/30 bg-black/40 text-gold-light font-bold text-sm uppercase rounded">
                        {{ ucfirst(str_replace('_', ' ', $order->manufacturing_status)) }}
                    </div>
                </div>

                <form action="{{ route('admin.orders.stage', $order) }}" method="POST" class="space-y-3 pt-3 border-t border-gold-antique/15">
                    @csrf
                    <label class="block text-[10px] uppercase text-gold-antique">Advance Stage in Karachi Ledger</label>
                    <select name="manufacturing_status" class="w-full border border-gold-antique/30 bg-black/50 p-2.5 text-xs text-ivory-base focus:border-gold-antique focus:outline-none rounded">
                        <option value="inquiry" {{ $order->manufacturing_status === 'inquiry' ? 'selected' : '' }}>01. Inquiry & Spot Lock</option>
                        <option value="in_workshop" {{ $order->manufacturing_status === 'in_workshop' ? 'selected' : '' }}>02. In Workshop (Karigar Casting)</option>
                        <option value="ready_for_dispatch" {{ $order->manufacturing_status === 'ready_for_dispatch' ? 'selected' : '' }}>03. Ready for Vault Dispatch</option>
                        <option value="completed" {{ $order->manufacturing_status === 'completed' ? 'selected' : '' }}>04. Completed & Delivered</option>
                    </select>
                    <button type="submit" class="w-full bg-gold-antique py-2.5 text-xs font-semibold uppercase tracking-wider text-oxblood-dark hover:bg-gold-light transition shadow-lg rounded">Update Stage</button>
                </form>
            </div>
        </div>

        <div x-show="zoomModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/90 backdrop-blur-md" @click="zoomModal = false">
            <div class="relative max-w-2xl max-h-[90vh] overflow-auto border border-gold-antique/50 bg-[#121212] p-2 rounded-lg" @click.stop>
                <img src="{{ route('admin.orders.slip', $order) }}" alt="Enlarged Slip" class="w-full h-auto rounded" />
                <button type="button" @click="zoomModal = false" class="absolute top-4 right-4 bg-oxblood-dark text-gold-light p-1 border border-gold-antique/40 rounded"><x-heroicon-m-x-mark class="h-6 w-6" /></button>
            </div>
        </div>

        <div x-show="rejectModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/85 backdrop-blur-md">
            <div class="w-full max-w-md border border-gold-antique/40 bg-[#121212] p-6 shadow-2xl text-ivory-base rounded-lg" @click.outside="rejectModal = false">
                <h4 class="font-serif text-base text-gold-light uppercase border-b border-gold-antique/20 pb-2 mb-3">Reject Deposit Slip</h4>
                <form action="{{ route('admin.orders.payment', $order) }}" method="POST" class="space-y-3">
                    @csrf
                    <input type="hidden" name="action" value="reject" />
                    <div>
                        <label class="block text-[10px] uppercase text-gold-antique mb-1">Reason for Rejection</label>
                        <textarea name="reason" rows="3" placeholder="e.g. Inconclusive reference number, incorrect amount..." class="w-full border border-gold-antique/30 bg-black/40 p-2 text-xs text-ivory-base focus:border-gold-antique focus:outline-none rounded"></textarea>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="rejectModal = false" class="px-4 py-2 text-xs border border-gold-antique/30 text-ivory-base hover:text-white rounded">Cancel</button>
                        <button type="submit" class="bg-red-800 hover:bg-red-700 px-4 py-2 text-xs font-semibold text-white uppercase rounded">Confirm Rejection</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>
