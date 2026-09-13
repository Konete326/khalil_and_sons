@php
    $rates = \App\Models\GoldRate::where('is_active', true)->get()->keyBy('karat');
    $r24k = $rates['24K'] ?? null;
    $r22k = $rates['22K'] ?? null;
    $r21k = $rates['21K'] ?? null;
    $r18k = $rates['18K'] ?? null;
    $silver = $rates['SILVER'] ?? null;
@endphp

<aside class="relative z-40 border-b border-gold-antique/20 bg-oxblood-dark px-3 py-1.5 text-ivory-base text-[10px] tracking-wider uppercase">
    <div class="mx-auto flex max-w-7xl xl:max-w-[1400px] items-center justify-between gap-4 px-3 sm:px-6 lg:px-8">
        <div class="flex items-center space-x-2 flex-shrink-0">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
            </span>
            <span class="font-serif font-medium text-gold-light tracking-[0.18em]">Sarafa Market Live</span>
        </div>

        <div class="flex items-center gap-3 sm:gap-6 overflow-x-auto scrollbar-none font-mono text-[10px] whitespace-nowrap text-ivory-base/90 py-0.5">
            <div class="flex items-center gap-1.5">
                <span class="text-gold-antique font-semibold">24K:</span>
                <span>Rs. {{ $r24k ? number_format($r24k->rate_per_tola) : '450,000' }}/Tola</span>
            </div>
            <span class="text-gold-antique/30">•</span>
            <div class="flex items-center gap-1.5">
                <span class="text-gold-antique font-semibold">22K:</span>
                <span>Rs. {{ $r22k ? number_format($r22k->rate_per_tola) : '412,500' }}/Tola</span>
            </div>
            <span class="text-gold-antique/30">•</span>
            <div class="flex items-center gap-1.5">
                <span class="text-gold-antique font-semibold">21K:</span>
                <span>Rs. {{ $r21k ? number_format($r21k->rate_per_tola) : '393,750' }}/Tola</span>
            </div>
            <span class="text-gold-antique/30">•</span>
            <div class="flex items-center gap-1.5">
                <span class="text-gold-antique font-semibold">18K:</span>
                <span>Rs. {{ $r18k ? number_format($r18k->rate_per_tola) : '337,500' }}/Tola</span>
            </div>
            <span class="text-gold-antique/30">•</span>
            <div class="flex items-center gap-1.5">
                <span class="text-gold-antique font-semibold">Chandi:</span>
                <span>Rs. {{ $silver ? number_format($silver->rate_per_tola) : '6,630' }}/Tola</span>
            </div>
        </div>

        <div class="hidden lg:flex items-center space-x-3 flex-shrink-0 text-gold-antique font-serif text-[10px]">
            <a href="{{ route('track') }}" class="underline hover:text-gold-light transition">Track Order</a>
        </div>
    </div>
</aside>
