<x-layouts.app :title="'Patron Salon Ledger | Khalil & Sons Jewellers'">
    <div class="min-h-[75vh] py-16 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-[#1c0404] via-oxblood-dark to-[#140202]">
        <div class="max-w-5xl mx-auto space-y-8">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-gold-antique/20 pb-6">
                <div>
                    <span class="text-[10px] font-mono tracking-[0.25em] text-gold-antique uppercase">Certified Patron Salon</span>
                    <h1 class="font-serif text-3xl text-gold-light mt-1 uppercase tracking-wider">{{ auth()->user()->name }}</h1>
                    <p class="text-xs text-ivory-base/70 font-sans mt-0.5">{{ auth()->user()->email }} • {{ auth()->user()->phone ?? 'No phone recorded' }}</p>
                </div>
                <div class="flex items-center gap-3">
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="bg-gold-antique px-4 py-2 text-xs font-semibold uppercase tracking-wider text-oxblood-dark hover:bg-gold-light transition shadow-lg">
                            Admin Control
                        </a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="border border-gold-antique/40 px-4 py-2 text-xs font-semibold uppercase tracking-wider text-gold-light hover:bg-gold-antique hover:text-oxblood-dark transition">
                            Sign Out
                        </button>
                    </form>
                </div>
            </div>

            @if(session('status'))
                <div class="border border-gold-antique/40 bg-gold-antique/10 p-4 text-xs text-gold-light text-center font-mono shadow-md">
                    {{ session('status') }}
                </div>
            @endif

            @php
                $userOrders = \App\Models\CustomOrder::where(function($q) {
                    $q->where('customer_email', auth()->user()->email)
                      ->orWhere('customer_phone', auth()->user()->phone);
                })->latest()->get();
            @endphp

            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <h2 class="font-serif text-lg text-gold-light uppercase tracking-wider">Your Custom Atelier Commissions</h2>
                    <a href="{{ route('bespoke') }}" class="text-xs text-gold-antique hover:text-gold-light underline font-mono">Commission New Piece &rarr;</a>
                </div>

                @if($userOrders->isEmpty())
                    <div class="border border-gold-antique/20 bg-black/40 p-10 text-center space-y-3">
                        <x-heroicon-o-sparkles class="h-10 w-10 mx-auto text-gold-antique/60" />
                        <h3 class="font-serif text-base text-gold-light">No Active Atelier Commissions Yet</h3>
                        <p class="text-xs text-ivory-base/60 max-w-md mx-auto">Commence your bespoke journey with our AI goldsmith atelier or reserve a private bridal salon viewing in Murshid Bazaar, Saddar.</p>
                        <div class="pt-3">
                            <a href="{{ route('bespoke') }}" class="inline-block bg-gold-antique px-5 py-2.5 text-xs font-semibold uppercase tracking-wider text-oxblood-dark hover:bg-gold-light transition">Start Bespoke Design</a>
                        </div>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 font-mono">
                        @foreach($userOrders as $order)
                            <div class="border border-gold-antique/30 bg-black/40 p-5 space-y-3 shadow-xl hover:border-gold-antique/60 transition">
                                <div class="flex items-start justify-between border-b border-gold-antique/20 pb-3">
                                    <div>
                                        <span class="text-[10px] uppercase text-gold-antique">Commission ID</span>
                                        <div class="text-sm font-bold text-gold-light">{{ $order->tracking_code }}</div>
                                    </div>
                                    <span class="text-[10px] uppercase px-2 py-0.5 border border-gold-antique/40 text-gold-light bg-gold-antique/10 font-sans">
                                        {{ ucfirst(str_replace('_', ' ', $order->manufacturing_status)) }}
                                    </span>
                                </div>
                                <div class="text-xs space-y-1 text-ivory-base/80">
                                    <div class="flex justify-between"><span>Karat Standard:</span><span class="text-gold-light">{{ $order->karat }}</span></div>
                                    <div class="flex justify-between"><span>Target Weight:</span><span>{{ $order->target_weight_grams }}g</span></div>
                                    <div class="flex justify-between"><span>Estimated Budget:</span><span class="text-gold-light font-bold">Rs. {{ number_format($order->estimated_budget) }}</span></div>
                                </div>
                                <div class="pt-2 border-t border-gold-antique/15 flex justify-between items-center text-xs">
                                    <span class="text-[10px] text-ivory-base/50">{{ $order->created_at->format('M d, Y') }}</span>
                                    <a href="{{ route('track', ['code' => $order->tracking_code]) }}" class="text-gold-antique hover:text-gold-light underline">View Real-time Track &rarr;</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>
