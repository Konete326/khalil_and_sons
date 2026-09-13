<x-layouts.app :title="'Official Sarafa Bullion Sheet | Khalil & Sons Jewellers'">
    <div class="min-h-[80vh] py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-[#140202] via-oxblood-dark to-[#0f0101] text-ivory-base" x-data="{
        exportCsv() {
            let rows = [
                ['Metal / Karat', 'Purity', 'Rate / Gram (PKR)', 'Rate / 10 Grams (PKR)', 'Rate / Tola (PKR)', 'USD Equivalent / Tola', 'Market Status'],
                @foreach([
                    ['24K', '24K Pure Gold (Bullion)', '99.9%'],
                    ['22K', '22K Bridal Gold (Saddar Benchmark)', '91.6%'],
                    ['21K', '21K Traditional Gold', '87.5%'],
                    ['18K', '18K Diamond Setting Gold', '75.0%'],
                    ['SILVER', 'Fine Silver (Chandi Bullion)', '99.9%'],
                ] as [$k, $title, $purity])
                    @php
                        $r = $rates[$k] ?? null;
                        $tola = $r ? $r->rate_per_tola : 0;
                        $gram = $r ? $r->rate_per_gram : 0;
                        $tenGram = round($gram * 10, 2);
                        $usd = $usdRate > 0 ? round($tola / $usdRate, 2) : 0;
                    @endphp
                    ['{{ $title }}', '{{ $purity }}', '{{ $gram }}', '{{ $tenGram }}', '{{ $tola }}', '${{ $usd }}', 'Verified Live'],
                @endforeach
            ];
            let csvContent = 'data:text/csv;charset=utf-8,' + rows.map(e => e.join(',')).join('\n');
            let encodedUri = encodeURI(csvContent);
            let link = document.createElement('a');
            link.setAttribute('href', encodedUri);
            link.setAttribute('download', 'khalil_sons_sarafa_rates_' + new Date().toISOString().slice(0,10) + '.csv');
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    }">
        <div class="max-w-6xl mx-auto space-y-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-gold-antique/20 pb-6">
                <div>
                    <div class="flex items-center space-x-2">
                        <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span class="text-[10px] font-mono uppercase tracking-[0.25em] text-gold-antique">Karachi Sarafa Association • Live Clearing</span>
                    </div>
                    <h1 class="font-serif text-2xl sm:text-4xl text-gold-light mt-1 uppercase tracking-wider">Official Bullion Valuation Sheet</h1>
                    <p class="text-xs text-ivory-base/70 mt-1 font-sans">Benchmarked against Murshid Bazaar spot trading. 1 Tola = 11.6638038 Grams.</p>
                </div>

                <div class="flex items-center gap-3">
                    <button type="button" @click="exportCsv()" class="border border-gold-antique/50 bg-black/40 hover:bg-gold-antique hover:text-oxblood-dark px-4 py-2 text-xs font-mono text-gold-light transition flex items-center space-x-2">
                        <x-heroicon-o-arrow-down-tray class="h-4 w-4" />
                        <span>Export CSV</span>
                    </button>
                    <button type="button" @click="window.print()" class="border border-gold-antique bg-gold-antique/20 hover:bg-gold-antique hover:text-oxblood-dark px-4 py-2 text-xs font-mono text-gold-light transition flex items-center space-x-2">
                        <x-heroicon-o-printer class="h-4 w-4" />
                        <span>Print Sheet</span>
                    </button>
                </div>
            </div>

            <div class="p-3 border border-gold-antique/30 bg-black/50 flex flex-col sm:flex-row items-center justify-between text-xs font-mono text-gold-antique">
                <span>Official Murshid Bazaar Sarafa Verification • Certificate #KS-910-SAD</span>
                <span>As of {{ now()->format('d M Y, h:i A') }} PST</span>
            </div>

            <div class="border border-gold-antique/30 bg-[#120303]/90 shadow-2xl overflow-x-auto">
                <table class="w-full text-left text-xs font-mono border-collapse min-w-[700px]">
                    <thead class="bg-black/70 text-gold-antique text-[11px] uppercase tracking-wider border-b border-gold-antique/30">
                        <tr>
                            <th class="p-4 border-r border-gold-antique/20">Metal / Karat Standard</th>
                            <th class="p-4 border-r border-gold-antique/20 text-center">Purity</th>
                            <th class="p-4 border-r border-gold-antique/20 text-right">Rate / Gram</th>
                            <th class="p-4 border-r border-gold-antique/20 text-right">Rate / 10 Grams</th>
                            <th class="p-4 border-r border-gold-antique/20 text-right">Rate / Tola (PKR)</th>
                            <th class="p-4 border-r border-gold-antique/20 text-right">USD Equiv.</th>
                            <th class="p-4 text-center">Market Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gold-antique/15 text-ivory-base/90">
                        @foreach([
                            ['24K', '24K Pure Gold (Bullion)', '99.9%'],
                            ['22K', '22K Bridal Gold (Benchmark)', '91.6%'],
                            ['21K', '21K Traditional Gold', '87.5%'],
                            ['18K', '18K Diamond Setting Gold', '75.0%'],
                            ['SILVER', 'Fine Silver (Chandi Bullion)', '99.9%'],
                        ] as [$k, $title, $purity])
                            @php
                                $r = $rates[$k] ?? null;
                                $tola = $r ? $r->rate_per_tola : 0;
                                $gram = $r ? $r->rate_per_gram : 0;
                                $tenGram = round($gram * 10, 2);
                                $usd = $usdRate > 0 ? round($tola / $usdRate, 2) : 0;
                            @endphp
                            <tr class="hover:bg-gold-antique/10 transition">
                                <td class="p-4 font-semibold text-gold-light border-r border-gold-antique/10 flex items-center space-x-2">
                                    <span class="h-1.5 w-1.5 rounded-full {{ $k === 'SILVER' ? 'bg-slate-300' : 'bg-gold-antique' }}"></span>
                                    <span>{{ $title }}</span>
                                </td>
                                <td class="p-4 text-center border-r border-gold-antique/10 text-ivory-base/70">{{ $purity }}</td>
                                <td class="p-4 text-right border-r border-gold-antique/10 font-bold">Rs. {{ number_format($gram, 2) }}</td>
                                <td class="p-4 text-right border-r border-gold-antique/10">Rs. {{ number_format($tenGram) }}</td>
                                <td class="p-4 text-right border-r border-gold-antique/10 font-bold text-gold-light text-sm">Rs. {{ number_format($tola) }}</td>
                                <td class="p-4 text-right border-r border-gold-antique/10 text-ivory-base/70">${{ number_format($usd, 2) }}</td>
                                <td class="p-4 text-center">
                                    <span class="inline-block px-2 py-0.5 border border-emerald-500/40 bg-emerald-950/60 text-emerald-300 text-[10px] uppercase">
                                        Live Sarafa
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs font-mono text-ivory-base/70 border-t border-gold-antique/20 pt-4">
                <div class="border border-gold-antique/20 bg-black/40 p-3">
                    <span class="text-gold-antique uppercase text-[10px] block">Standard Conversion Formula:</span>
                    <p class="mt-1">1 Tola = 11.6638g • 1 Gram = Tola / 11.6638</p>
                </div>
                <div class="border border-gold-antique/20 bg-black/40 p-3">
                    <span class="text-gold-antique uppercase text-[10px] block">Making & Deduction Rules:</span>
                    <p class="mt-1">Plain Gold: Rs. 1,000/g • Studded: Rs. 1,500/g</p>
                </div>
                <div class="border border-gold-antique/20 bg-black/40 p-3">
                    <span class="text-gold-antique uppercase text-[10px] block">Showroom Direct Settlement:</span>
                    <p class="mt-1">Meezan IBAN & State Bank Raast available</p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
