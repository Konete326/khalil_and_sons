<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Khalil_and_Sons_Sarafa_Rates_{{ now()->format('Y-m-d') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: #ffffff !important; color: #000000 !important; margin: 0; padding: 0; }
            @page { margin: 12mm; size: A4 portrait; }
        }
    </style>
</head>
<body class="bg-white text-black font-sans antialiased p-6 sm:p-10 max-w-5xl mx-auto min-h-screen flex flex-col justify-between">
    <div class="no-print mb-6 p-3 bg-neutral-900 text-white flex items-center justify-between shadow-lg text-xs font-mono">
        <div class="flex items-center gap-2">
            <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
            <span>Official Publication Sheet • Ready for PDF Export / Print</span>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('gold.rates') }}" class="px-3 py-1.5 border border-neutral-700 hover:bg-neutral-800 transition text-neutral-300">Return to Website</a>
            <button type="button" onclick="window.print()" class="px-4 py-1.5 bg-amber-500 hover:bg-amber-400 text-black font-bold uppercase tracking-wider transition">Print / Save as PDF</button>
        </div>
    </div>

    <div>
        <div class="border-b-2 border-black pb-4 mb-6">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                <div>
                    <h1 class="font-serif text-2xl sm:text-3xl font-bold tracking-wider uppercase text-black">KHALIL & SON'S JEWELLERS</h1>
                    <p class="text-xs font-serif uppercase tracking-widest text-neutral-700 mt-0.5">Murshid Bazaar, Saddar, Karachi • Est. 1991</p>
                    <p class="text-[10px] font-mono text-neutral-500 mt-1">Official Sarafa Association Clearing Member • Lic #SAD-KAR-1991</p>
                </div>
                <div class="sm:text-right font-mono text-xs">
                    <div class="inline-block border border-black px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider bg-neutral-100">Daily Sarafa Bullion Valuation</div>
                    <div class="mt-2 text-[11px] text-neutral-800">Date: <span class="font-bold">{{ now()->format('d F Y') }}</span></div>
                    <div class="text-[10px] text-neutral-600">Timestamp: {{ now()->format('h:i:s A T') }}</div>
                </div>
            </div>
        </div>

        <div class="mb-4 bg-neutral-50 border border-neutral-300 p-3 text-xs font-mono flex flex-col sm:flex-row justify-between gap-2 text-neutral-700">
            <div>Standard: <strong class="text-black">1 Tola = 11.6638038 Grams</strong> (10 Tolas = 116.638g)</div>
            <div>USD Conversion Base: <strong class="text-black">Rs. {{ number_format($usdRate, 2) }} / USD</strong></div>
            <div>Sarafa Session: <strong class="text-black">Active Day Clearing</strong></div>
        </div>

        <table class="w-full border-collapse border border-black text-xs font-mono my-6">
            <thead>
                <tr class="bg-neutral-200 border-b-2 border-black text-[11px] font-bold text-black uppercase">
                    <th class="border border-black p-2.5 text-left">Metal / Karat Standard</th>
                    <th class="border border-black p-2.5 text-center">Purity</th>
                    <th class="border border-black p-2.5 text-right">Rate / Gram (PKR)</th>
                    <th class="border border-black p-2.5 text-right">Rate / 10g (PKR)</th>
                    <th class="border border-black p-2.5 text-right bg-neutral-300">Rate / Tola (PKR)</th>
                    <th class="border border-black p-2.5 text-right">USD Equiv. / Tola</th>
                </tr>
            </thead>
            <tbody>
                @foreach([
                    ['24K', '24K Pure Gold (Bullion / Tezabi)', '99.9%'],
                    ['22K', '22K Sovereign Gold (Bridal Benchmark)', '91.6%'],
                    ['21K', '21K Traditional Gulf / Pakistani Gold', '87.5%'],
                    ['18K', '18K Diamond Setting White & Yellow Gold', '75.0%'],
                    ['SILVER', 'Fine Silver Bullion (999 Chandi)', '99.9%'],
                ] as [$k, $title, $purity])
                    @php
                        $r = $rates[$k] ?? null;
                        $tola = $r ? $r->rate_per_tola : 0;
                        $gram = $r ? $r->rate_per_gram : 0;
                        $tenGram = round($gram * 10, 2);
                        $usd = $usdRate > 0 ? round($tola / $usdRate, 2) : 0;
                    @endphp
                    <tr class="border-b border-black/70 hover:bg-neutral-100">
                        <td class="border border-black p-2.5 font-bold text-black">{{ $title }}</td>
                        <td class="border border-black p-2.5 text-center font-semibold text-neutral-800">{{ $purity }}</td>
                        <td class="border border-black p-2.5 text-right font-medium">Rs. {{ number_format($gram, 2) }}</td>
                        <td class="border border-black p-2.5 text-right font-medium">Rs. {{ number_format($tenGram) }}</td>
                        <td class="border border-black p-2.5 text-right font-bold text-black bg-neutral-100 text-sm">Rs. {{ number_format($tola) }}</td>
                        <td class="border border-black p-2.5 text-right font-medium text-neutral-800">${{ number_format($usd, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 border border-neutral-400 p-4 text-[10px] font-mono text-neutral-800 mb-8 bg-neutral-50/50">
            <div>
                <h4 class="font-bold uppercase text-black border-b border-neutral-300 pb-1 mb-1.5">Bullion Policy & Rate Lock Standards</h4>
                <p>1. 100% advance gold deposit is mandatory to fix the spot rate against market fluctuation.</p>
                <p>2. Plain jewellery making charge benchmark: Rs. 1,000/g. Studded Jadau/Kundan: Rs. 1,500/g.</p>
            </div>
            <div>
                <h4 class="font-bold uppercase text-black border-b border-neutral-300 pb-1 mb-1.5">Gemstone Weight & Hallmarking Protocol</h4>
                <p>1. Stones &le; 1.5mm stay within gross weight; stones &gt; 1.5mm deducted and charged separately.</p>
                <p>2. Certified hallmark verification conducted at Karachi Sarafa Testing Laboratory.</p>
            </div>
        </div>

        <div class="flex justify-between items-end border-t border-dashed border-neutral-400 pt-6 pb-2 text-[10px] font-mono">
            <div>
                <p class="font-bold text-black">Murshid Bazaar Head Desk</p>
                <p class="text-neutral-600">Verification Hash: {{ strtoupper(substr(md5(now()->toDateString() . 'ks_sarafa'), 0, 16)) }}</p>
            </div>
            <div class="text-center w-48 border-t border-black pt-1">
                <p class="uppercase text-neutral-800 text-[9px] font-semibold">Authorised Clearing Signatory</p>
            </div>
        </div>
    </div>

    <footer class="border-t-2 border-black pt-3 mt-8 flex flex-col sm:flex-row justify-between items-center text-[9px] font-mono text-neutral-600">
        <div>Official Record • Khalil & Son's Jewellers • Saddar, Karachi • All Rights Reserved</div>
        <div class="mt-1 sm:mt-0 font-medium text-neutral-500">Engineered by Elite Dev Agency</div>
    </footer>

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            if (!window.location.search.includes('noprint')) {
                setTimeout(() => window.print(), 350);
            }
        });
    </script>
</body>
</html>
