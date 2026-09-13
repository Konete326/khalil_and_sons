<x-layouts.admin :title="'Custom Order Pipeline | Khalil & Sons Jewellers'">
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-gold-antique/20 pb-4">
            <div>
                <span class="text-[10px] font-mono uppercase tracking-[0.25em] text-gold-antique">Bespoke Workshop Registry</span>
                <h2 class="font-serif text-2xl sm:text-3xl text-gold-light mt-1">Commissions & Deposit Slips</h2>
            </div>

            <div class="flex items-center gap-2 overflow-x-auto scrollbar-none text-xs font-mono">
                <a href="{{ route('admin.orders.index', ['status' => 'all']) }}" class="px-3 py-1.5 border transition {{ $filter === 'all' ? 'border-gold-antique bg-gold-antique text-oxblood-dark font-bold' : 'border-gold-antique/30 text-ivory-base hover:text-gold-light' }}">All</a>
                <a href="{{ route('admin.orders.index', ['status' => 'pending_slip']) }}" class="px-3 py-1.5 border transition {{ $filter === 'pending_slip' ? 'border-amber-400 bg-amber-400 text-black font-bold' : 'border-amber-500/40 text-amber-300 hover:text-amber-100' }}">Pending Slips</a>
                <a href="{{ route('admin.orders.index', ['status' => 'in_workshop']) }}" class="px-3 py-1.5 border transition {{ $filter === 'in_workshop' ? 'border-gold-antique bg-gold-antique text-oxblood-dark font-bold' : 'border-gold-antique/30 text-ivory-base hover:text-gold-light' }}">In Workshop</a>
                <a href="{{ route('admin.orders.index', ['status' => 'ready_for_dispatch']) }}" class="px-3 py-1.5 border transition {{ $filter === 'ready_for_dispatch' ? 'border-gold-antique bg-gold-antique text-oxblood-dark font-bold' : 'border-gold-antique/30 text-ivory-base hover:text-gold-light' }}">Ready</a>
                <a href="{{ route('admin.orders.index', ['status' => 'completed']) }}" class="px-3 py-1.5 border transition {{ $filter === 'completed' ? 'border-emerald-400 bg-emerald-400 text-black font-bold' : 'border-emerald-500/40 text-emerald-300 hover:text-emerald-100' }}">Completed</a>
            </div>
        </div>

        <div class="border border-gold-antique/30 bg-oxblood-dark/90 p-5 shadow-2xl overflow-x-auto">
            <table class="w-full text-left text-xs font-mono">
                <thead class="border-b border-gold-antique/20 text-gold-antique text-[10px] uppercase">
                    <tr>
                        <th class="pb-3">Tracking Code</th>
                        <th class="pb-3">Patron Details</th>
                        <th class="pb-3">Specification</th>
                        <th class="pb-3">Estimated Budget</th>
                        <th class="pb-3">Payment</th>
                        <th class="pb-3">Manufacturing</th>
                        <th class="pb-3 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gold-antique/10 text-ivory-base/90">
                    @forelse($orders as $ord)
                        <tr class="hover:bg-black/30 transition">
                            <td class="py-3.5 font-bold text-gold-light">{{ $ord->tracking_code }}</td>
                            <td class="py-3.5">
                                <div class="font-medium text-ivory-base">{{ $ord->customer_name }}</div>
                                <div class="text-[10px] text-ivory-base/60">{{ $ord->customer_phone }}</div>
                            </td>
                            <td class="py-3.5">
                                <span class="text-gold-light font-semibold">{{ $ord->karat }}</span> • {{ $ord->target_weight_grams }}g
                            </td>
                            <td class="py-3.5 text-gold-light font-semibold">
                                Rs. {{ number_format($ord->estimated_budget) }}
                            </td>
                            <td class="py-3.5">
                                <span class="inline-block px-2 py-0.5 text-[9px] uppercase tracking-wider {{ $ord->payment_status === 'verified' ? 'bg-emerald-950 text-emerald-300 border border-emerald-500/40' : ($ord->payment_status === 'slip_uploaded' ? 'bg-amber-950 text-amber-300 border border-amber-500/40 animate-pulse' : ($ord->payment_status === 'rejected' ? 'bg-red-950 text-red-300 border border-red-500/40' : 'bg-black/50 text-ivory-base/60 border border-gold-antique/20')) }}">
                                    {{ $ord->payment_status }}
                                </span>
                            </td>
                            <td class="py-3.5">
                                <span class="inline-block px-2 py-0.5 text-[9px] uppercase tracking-wider border border-gold-antique/30 bg-oxblood/60 text-gold-light">
                                    {{ ucfirst(str_replace('_', ' ', $ord->manufacturing_status)) }}
                                </span>
                            </td>
                            <td class="py-3.5 text-right">
                                <a href="{{ route('admin.orders.show', $ord) }}" class="border border-gold-antique/50 bg-gold-antique/10 hover:bg-gold-antique hover:text-oxblood-dark px-3 py-1.5 text-[10px] font-semibold tracking-wider uppercase text-gold-light transition">
                                    Inspect
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-10 text-center text-ivory-base/50">No commission records matching the selected status filter.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4 pt-4 border-t border-gold-antique/15">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</x-layouts.admin>
