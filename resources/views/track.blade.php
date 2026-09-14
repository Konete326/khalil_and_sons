<x-layouts.app :title="'Live Order Tracking | Khalil & Sons Jewellers'">
    <section class="relative min-h-screen bg-gradient-to-b from-oxblood-dark via-[#250505] to-ivory-base pt-16 pb-24 text-ivory-base">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <div class="inline-flex items-center gap-2 border border-gold-antique/40 bg-oxblood-dark/90 px-4 py-1.5 shadow-xl">
                    <span class="h-1.5 w-1.5 rounded-full bg-gold-antique animate-pulse"></span>
                    <span class="text-[10px] font-semibold tracking-[0.25em] text-gold-light uppercase">Sarafa Atelier Manufacturing Tracker</span>
                </div>
                <h1 class="mt-5 font-serif text-3xl sm:text-4xl text-gold-light">Track Your Bespoke Commission</h1>
                <p class="mt-2 text-xs sm:text-sm text-ivory-base/70 max-w-xl mx-auto font-light">Monitor real-time progress from master hand-casting in Murshid Bazaar to official Sarafa hallmarking.</p>
            </div>

            <form action="{{ route('track') }}" method="GET" class="max-w-md mx-auto mb-12 flex gap-2">
                <input type="text" name="code" value="{{ $searchCode }}" placeholder="Enter Tracking Code (e.g. KS-ORD-XXXXXX)" class="flex-1 border border-gold-antique/40 bg-black/50 px-4 py-2.5 text-xs text-ivory-base placeholder-ivory-base/40 focus:border-gold-antique focus:outline-none" required />
                <button type="submit" class="bg-gold-antique px-6 py-2.5 text-xs font-semibold uppercase tracking-wider text-oxblood-dark hover:bg-gold-light transition shadow-lg">Track</button>
            </form>

            @if($order)
                @php
                    $step = match($order->manufacturing_status) {
                        'completed' => 4,
                        'ready_for_dispatch' => 3,
                        'in_workshop' => 2,
                        default => ($order->payment_status === 'verified' ? 2 : ($order->payment_status === 'slip_uploaded' ? 1 : 1))
                    };
                    $nameParts = explode(' ', trim($order->customer_name));
                    $maskedName = count($nameParts) > 1 ? $nameParts[0] . ' ' . substr($nameParts[1], 0, 1) . '.' : substr($order->customer_name, 0, 1) . '***';
                    $phoneDigits = preg_replace('/[^0-9]/', '', $order->customer_phone);
                    $maskedPhone = strlen($phoneDigits) >= 7 ? substr($phoneDigits, 0, 4) . '****' . substr($phoneDigits, -3) : substr($order->customer_phone, 0, 3) . '****';
                @endphp
                <div class="border border-gold-antique/30 bg-oxblood-dark/90 p-6 sm:p-8 shadow-2xl space-y-8">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-gold-antique/20 pb-5 gap-4">
                        <div>
                            <span class="text-[10px] uppercase tracking-widest text-gold-antique">Commission ID:</span>
                            <h2 class="font-mono text-xl sm:text-2xl text-gold-light font-bold">{{ $order->tracking_code }}</h2>
                            <p class="text-xs text-ivory-base/70 mt-1">Patron: {{ $maskedName }} • {{ $maskedPhone }}</p>
                        </div>
                        <div class="sm:text-right">
                            <span class="inline-block border border-gold-antique/40 bg-gold-antique/10 px-3 py-1 text-xs uppercase tracking-widest text-gold-light font-semibold">Status: {{ ucfirst(str_replace('_', ' ', $order->manufacturing_status)) }}</span>
                            <p class="text-[10px] text-ivory-base/50 mt-1 font-mono">Booked: {{ $order->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-center font-mono">
                        <div class="p-3 border {{ $step >= 1 ? 'border-gold-antique bg-gold-antique/10 text-gold-light' : 'border-gold-antique/20 opacity-40' }}">
                            <div class="text-xs font-bold">01. INQUIRY</div>
                            <div class="text-[9px] uppercase mt-1">Spot Locked</div>
                        </div>
                        <div class="p-3 border {{ $step >= 2 ? 'border-gold-antique bg-gold-antique/10 text-gold-light' : 'border-gold-antique/20 opacity-40' }}">
                            <div class="text-xs font-bold">02. SLIP VERIFIED</div>
                            <div class="text-[9px] uppercase mt-1">Sarafa Clearing</div>
                        </div>
                        <div class="p-3 border {{ $step >= 3 ? 'border-gold-antique bg-gold-antique/10 text-gold-light' : 'border-gold-antique/20 opacity-40' }}">
                            <div class="text-xs font-bold">03. IN WORKSHOP</div>
                            <div class="text-[9px] uppercase mt-1">Karigar Casting</div>
                        </div>
                        <div class="p-3 border {{ $step >= 4 ? 'border-gold-antique bg-gold-antique/10 text-gold-light' : 'border-gold-antique/20 opacity-40' }}">
                            <div class="text-xs font-bold">04. DISPATCH</div>
                            <div class="text-[9px] uppercase mt-1">Hallmarked & Ready</div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t border-gold-antique/20 pt-6 text-xs font-mono">
                        <div class="space-y-3">
                            <h3 class="font-serif text-sm text-gold-light uppercase tracking-wider font-sans">Artisan Specification</h3>
                            <div class="flex justify-between border-b border-gold-antique/15 pb-1.5"><span class="text-ivory-base/70">Purity Standard:</span><span class="text-gold-light">{{ $order->karat }} Hallmarked Solid Gold</span></div>
                            <div class="flex justify-between border-b border-gold-antique/15 pb-1.5"><span class="text-ivory-base/70">Target Weight:</span><span>{{ $order->target_weight_grams }} grams</span></div>
                            <div class="flex justify-between border-b border-gold-antique/15 pb-1.5"><span class="text-ivory-base/70">Estimated Budget:</span><span class="text-gold-light font-bold">Rs. {{ number_format($order->estimated_budget) }}</span></div>
                            <div class="flex justify-between border-b border-gold-antique/15 pb-1.5"><span class="text-ivory-base/70">Payment Status:</span><span class="uppercase text-gold-antique font-semibold">{{ $order->payment_status }}</span></div>
                        </div>

                        <div class="space-y-3">
                            <h3 class="font-serif text-sm text-gold-light uppercase tracking-wider font-sans">Verification Slip</h3>
                            @if($order->payment_slip_path)
                                <div class="border border-gold-antique/30 bg-black/40 p-3 flex items-center justify-between">
                                    <span class="text-[11px] text-emerald-400">Slip Uploaded & Under Review</span>
                                    <span class="text-[10px] font-mono text-gold-antique uppercase">Sarafa Clearing</span>
                                </div>
                            @else
                                <form action="{{ route('atelier.slip', ['code' => $order->tracking_code]) }}" method="POST" enctype="multipart/form-data" class="space-y-2">
                                    @csrf
                                    <label class="block text-[10px] uppercase text-gold-antique">Attach Deposit Receipt / Raast Screenshot</label>
                                    <input type="file" name="slip" accept="image/jpeg,image/png,image/webp" required class="w-full border border-gold-antique/30 bg-black/30 p-1.5 text-xs text-ivory-base" />
                                    <button type="submit" class="bg-gold-antique px-4 py-2 text-[11px] font-semibold uppercase tracking-wider text-oxblood-dark hover:bg-gold-light transition">Upload Payment Slip</button>
                                </form>
                            @endif
                            <div class="pt-2">
                                <a href="https://wa.me/923001234567?text={{ urlencode('Assalam-o-Alaikum, inquiring about bespoke order ' . $order->tracking_code) }}" target="_blank" class="inline-flex items-center gap-2 border border-[#25D366]/50 bg-[#25D366]/10 px-4 py-2 text-xs text-[#25D366] hover:bg-[#25D366] hover:text-black transition">
                                    <span>WhatsApp Concierge for {{ $order->tracking_code }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif(!empty($searchCode))
                <div class="border border-gold-antique/30 bg-oxblood-dark/80 p-8 text-center max-w-lg mx-auto shadow-2xl">
                    <p class="font-serif text-lg text-gold-light">No order record found for "{{ $searchCode }}"</p>
                    <p class="mt-2 text-xs text-ivory-base/70">Verify your tracking code format (e.g. KS-ORD-XXXXXX) or consult our Saddar VIP concierge on WhatsApp.</p>
                </div>
            @endif
        </div>
    </section>
</x-layouts.app>
