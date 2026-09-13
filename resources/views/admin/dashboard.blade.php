<x-layouts.admin :title="'Operations Dashboard | Khalil & Sons Jewellers'">
    <div class="space-y-8 w-full">
        <div>
            <span class="text-[10px] font-mono uppercase tracking-[0.25em] text-gold-antique">Sarafa Commercial Executive Suite</span>
            <h2 class="font-serif text-2xl sm:text-3xl text-gold-light mt-1">Showroom Operations & Manufacturing Pipeline</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 font-mono">
            <div class="bg-[#121212] border border-gold-antique/20 rounded-lg p-5 shadow-xl">
                <span class="text-[10px] uppercase text-ivory-base/60">Active Workshop Commissions</span>
                <div class="mt-2 text-3xl font-serif text-gold-light">{{ $activeOrdersCount }}</div>
                <span class="text-[10px] text-emerald-400">In Production & Inquiry</span>
            </div>

            <div class="bg-[#121212] border border-gold-antique/20 rounded-lg p-5 shadow-xl">
                <span class="text-[10px] uppercase text-ivory-base/60">Pending Slip Verifications</span>
                <div class="mt-2 text-3xl font-serif {{ $pendingSlipsCount > 0 ? 'text-amber-400' : 'text-gold-light' }}">{{ $pendingSlipsCount }}</div>
                <a href="{{ route('admin.orders.index', ['status' => 'pending_slip']) }}" class="text-[10px] text-gold-antique underline hover:text-gold-light">Inspect customer receipts &rarr;</a>
            </div>

            <div class="bg-[#121212] border border-gold-antique/20 rounded-lg p-5 shadow-xl">
                <span class="text-[10px] uppercase text-ivory-base/60">Verified Pipeline Volume</span>
                <div class="mt-2 text-2xl font-serif text-gold-light">Rs. {{ number_format($pipelineRevenue) }}</div>
                <span class="text-[10px] text-gold-antique">100% Spot Gold Locked</span>
            </div>

            <div class="bg-[#121212] border border-gold-antique/20 rounded-lg p-5 shadow-xl">
                <span class="text-[10px] uppercase text-ivory-base/60">Live 22K Sarafa Rate</span>
                <div class="mt-2 text-2xl font-serif text-gold-light">Rs. {{ isset($rates['22K']) ? number_format($rates['22K']->rate_per_tola) : '412,500' }}</div>
                <span class="text-[10px] text-ivory-base/70">Rs. {{ isset($rates['22K']) ? number_format($rates['22K']->rate_per_gram) : '35,365' }}/g</span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
            <div class="lg:col-span-2 bg-[#121212] border border-gold-antique/20 rounded-lg p-6 shadow-2xl">
                <div class="flex items-center justify-between border-b border-gold-antique/20 pb-4 mb-4">
                    <h3 class="font-serif text-base text-gold-light uppercase tracking-wider">Recent Custom Commissions</h3>
                    <a href="{{ route('admin.orders.index') }}" class="text-xs font-mono text-gold-antique hover:text-gold-light underline">View All ({{ $activeOrdersCount }})</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs font-mono">
                        <thead class="border-b border-gold-antique/20 text-gold-antique text-[10px] uppercase">
                            <tr>
                                <th class="pb-2.5">Code</th>
                                <th class="pb-2.5">Patron</th>
                                <th class="pb-2.5">Karat / Wt</th>
                                <th class="pb-2.5">Budget</th>
                                <th class="pb-2.5">Status</th>
                                <th class="pb-2.5 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gold-antique/10 text-ivory-base/90">
                            @forelse($recentOrders as $ord)
                                <tr class="hover:bg-white/5 transition">
                                    <td class="py-3 font-bold text-gold-light">{{ $ord->tracking_code }}</td>
                                    <td class="py-3">{{ $ord->customer_name }}</td>
                                    <td class="py-3">{{ $ord->karat }} • {{ $ord->target_weight_grams }}g</td>
                                    <td class="py-3 text-gold-light">Rs. {{ number_format($ord->estimated_budget) }}</td>
                                    <td class="py-3">
                                        <span class="inline-block px-2 py-0.5 text-[9px] uppercase tracking-wider {{ $ord->payment_status === 'verified' ? 'bg-emerald-950 text-emerald-300 border border-emerald-500/40' : ($ord->payment_status === 'slip_uploaded' ? 'bg-amber-950 text-amber-300 border border-amber-500/40' : 'bg-oxblood text-ivory-base/70 border border-gold-antique/20') }}">
                                            {{ $ord->payment_status }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-right">
                                        <a href="{{ route('admin.orders.show', $ord) }}" class="border border-gold-antique/40 px-2.5 py-1 text-[10px] text-gold-light hover:bg-gold-antique hover:text-oxblood-dark transition rounded">Inspect</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-6 text-center text-ivory-base/50">No custom commissions placed yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-[#121212] border border-gold-antique/20 rounded-lg p-6 shadow-2xl">
                    <h3 class="font-serif text-base text-gold-light uppercase tracking-wider border-b border-gold-antique/20 pb-3 mb-4">Quick Operations</h3>
                    <div class="space-y-3">
                        <a href="{{ route('admin.rates.index') }}" class="block w-full border border-gold-antique/60 bg-gold-antique/10 hover:bg-gold-antique hover:text-oxblood-dark p-3 text-xs uppercase tracking-widest text-gold-light transition text-center font-semibold rounded">1-Click Sarafa Override</a>
                        <a href="{{ route('admin.orders.index', ['status' => 'pending_slip']) }}" class="block w-full border border-amber-500/60 bg-amber-500/10 hover:bg-amber-500 hover:text-black p-3 text-xs uppercase tracking-widest text-amber-300 transition text-center font-semibold rounded">Verify Customer Slips ({{ $pendingSlipsCount }})</a>
                        <a href="{{ route('admin.payments.index') }}" class="block w-full border border-gold-antique/40 hover:bg-white/10 p-3 text-xs uppercase tracking-widest text-ivory-base transition text-center rounded">Manage Bank Accounts</a>
                    </div>
                </div>

                <div class="bg-[#121212] border border-gold-antique/20 rounded-lg p-5 text-xs font-mono space-y-2 text-ivory-base/80">
                    <div class="text-gold-antique uppercase text-[10px] font-serif">Sarafa Commercial Rules:</div>
                    <p>• Plain Karigari: Flat Rs. 1,000/g</p>
                    <p>• Studded Karigari: Flat Rs. 1,500/g</p>
                    <p>• 1.5mm Stone Rule: &le;1.5mm in gold weight; &gt;1.5mm deducted</p>
                    <p>• 100% Gold Advance locks spot price</p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
