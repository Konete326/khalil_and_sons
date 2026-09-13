<x-layouts.admin :title="'Sarafa Metal Rates Management | Khalil & Sons Jewellers'">
    <div class="space-y-8 max-w-5xl">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-gold-antique/20 pb-4">
            <div>
                <span class="text-[10px] font-mono uppercase tracking-[0.25em] text-gold-antique">Karachi Sarafa Market Terminal</span>
                <h2 class="font-serif text-2xl sm:text-3xl text-gold-light mt-1">Daily Spot Valuation & 1-Click Override</h2>
            </div>
            <form action="{{ route('admin.rates.sync') }}" method="POST">
                @csrf
                <button type="submit" class="border border-gold-antique/60 bg-gold-antique/20 hover:bg-gold-antique hover:text-oxblood-dark px-4 py-2.5 text-xs font-semibold uppercase tracking-wider text-gold-light transition shadow-lg flex items-center space-x-2">
                    <x-heroicon-o-arrow-path class="h-4 w-4" />
                    <span>Trigger GoldAPI Sync</span>
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-2 border border-gold-antique/30 bg-oxblood-dark/90 p-6 shadow-2xl">
                <h3 class="font-serif text-base text-gold-light uppercase tracking-wider border-b border-gold-antique/20 pb-3 mb-4">Active Spot Ledger</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs font-mono">
                        <thead class="border-b border-gold-antique/20 text-gold-antique text-[10px] uppercase">
                            <tr>
                                <th class="pb-2.5">Metal / Karat</th>
                                <th class="pb-2.5">Rate / Tola (PKR)</th>
                                <th class="pb-2.5">Rate / Gram (PKR)</th>
                                <th class="pb-2.5 text-right">Effective</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gold-antique/10 text-ivory-base/90">
                            @foreach(['24K', '22K', '21K', '18K', 'SILVER'] as $k)
                                @php $r = $rates[$k] ?? null; @endphp
                                <tr class="hover:bg-black/30 transition">
                                    <td class="py-3 font-semibold text-gold-light">{{ $k === 'SILVER' ? 'Fine Silver (Chandi)' : "{$k} Solid Gold" }}</td>
                                    <td class="py-3 text-gold-light font-bold">Rs. {{ $r ? number_format($r->rate_per_tola) : 'N/A' }}</td>
                                    <td class="py-3">Rs. {{ $r ? number_format($r->rate_per_gram, 2) : 'N/A' }}</td>
                                    <td class="py-3 text-right text-[10px] text-ivory-base/60">{{ $r?->effective_date ? $r->effective_date->format('M d, H:i') : 'Active' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="border border-gold-antique/40 bg-black/60 p-6 shadow-2xl" x-data="{ tola: 415000, get gram() { return (this.tola / 11.6638).toFixed(2); } }">
                <h3 class="font-serif text-base text-gold-light uppercase tracking-wider border-b border-gold-antique/20 pb-3 mb-4">1-Click Override</h3>
                <form action="{{ route('admin.rates.update') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-[10px] uppercase tracking-widest text-gold-antique mb-1">Select Karat / Metal</label>
                        <select name="karat" class="w-full border border-gold-antique/30 bg-oxblood-dark p-2.5 text-xs text-ivory-base focus:border-gold-antique focus:outline-none">
                            <option value="22K">22K Gold (Bridal Benchmark)</option>
                            <option value="24K">24K Pure Gold (Bullion)</option>
                            <option value="21K">21K Gold</option>
                            <option value="18K">18K Gold (Diamond Setting)</option>
                            <option value="SILVER">Fine Silver (Chandi)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] uppercase tracking-widest text-gold-antique mb-1">New Tola Rate (PKR)</label>
                        <input type="number" step="100" name="rate_per_tola" x-model.number="tola" required class="w-full border border-gold-antique/30 bg-oxblood-dark p-2.5 text-xs text-ivory-base focus:border-gold-antique focus:outline-none font-mono" />
                    </div>

                    <div class="p-3 border border-gold-antique/20 bg-oxblood-dark/80 text-[11px] font-mono">
                        <span class="text-ivory-base/60">Calculated Per Gram:</span>
                        <div class="text-gold-light font-bold text-sm mt-0.5" x-text="'Rs. ' + parseFloat(gram).toLocaleString() + ' / g'"></div>
                    </div>

                    <button type="submit" class="w-full bg-gold-antique py-2.5 text-xs font-semibold uppercase tracking-[0.2em] text-oxblood-dark hover:bg-gold-light transition shadow-xl">
                        Commit Rate Override
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>
