<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? "Sarafa Operations Control | Khalil & Sons Jewellers" }}</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#180303] text-ivory-base font-sans antialiased flex" x-data="{ sidebarOpen: false }">
    <div x-show="sidebarOpen" x-cloak class="fixed inset-0 z-40 bg-black/80 md:hidden" @click="sidebarOpen = false"></div>

    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'" class="fixed md:static inset-y-0 left-0 z-50 flex flex-col justify-between w-64 bg-oxblood-dark border-r border-gold-antique/25 transition-transform duration-300 ease-in-out p-6">
        <div>
            <div class="flex items-center space-x-3 border-b border-gold-antique/20 pb-4">
                <img src="{{ asset('assets/logo.png') }}" alt="Khalil & Sons" class="h-8 w-8 object-contain" />
                <div>
                    <h1 class="font-serif text-sm font-semibold tracking-[0.18em] text-gold-light uppercase">Khalil & Sons</h1>
                    <p class="text-[9px] font-sans tracking-widest text-gold-antique uppercase">Sarafa Atelier Portal</p>
                </div>
            </div>

            <nav class="mt-6 space-y-1.5 font-serif text-xs">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-none transition {{ request()->routeIs('admin.dashboard') ? 'bg-gold-antique text-oxblood-dark font-semibold' : 'text-ivory-base/80 hover:bg-gold-antique/10 hover:text-gold-light' }}">
                    <x-heroicon-o-home class="h-4 w-4 flex-shrink-0" />
                    <span>Overview</span>
                </a>
                <a href="{{ route('admin.orders.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-none transition {{ request()->routeIs('admin.orders.*') ? 'bg-gold-antique text-oxblood-dark font-semibold' : 'text-ivory-base/80 hover:bg-gold-antique/10 hover:text-gold-light' }}">
                    <x-heroicon-o-clipboard-document-check class="h-4 w-4 flex-shrink-0" />
                    <span>Orders & Slips</span>
                </a>
                <a href="{{ route('admin.rates.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-none transition {{ request()->routeIs('admin.rates.*') ? 'bg-gold-antique text-oxblood-dark font-semibold' : 'text-ivory-base/80 hover:bg-gold-antique/10 hover:text-gold-light' }}">
                    <x-heroicon-o-currency-dollar class="h-4 w-4 flex-shrink-0" />
                    <span>Sarafa Metal Rates</span>
                </a>
                <a href="{{ route('admin.payments.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-none transition {{ request()->routeIs('admin.payments.*') ? 'bg-gold-antique text-oxblood-dark font-semibold' : 'text-ivory-base/80 hover:bg-gold-antique/10 hover:text-gold-light' }}">
                    <x-heroicon-o-building-library class="h-4 w-4 flex-shrink-0" />
                    <span>Payment Methods</span>
                </a>
                <a href="{{ route('home') }}" target="_blank" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-none text-gold-antique hover:text-gold-light transition mt-6 pt-4 border-t border-gold-antique/15">
                    <x-heroicon-o-arrow-top-right-on-square class="h-4 w-4 flex-shrink-0" />
                    <span>View Storefront</span>
                </a>
            </nav>
        </div>

        <div class="border-t border-gold-antique/20 pt-4 text-xs">
            <div class="mb-3">
                <p class="text-[10px] uppercase tracking-widest text-gold-antique">Active Proprietor</p>
                <p class="font-serif text-gold-light truncate">{{ auth()->user()?->name ?? 'Proprietor' }}</p>
            </div>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-left px-3 py-2 border border-gold-antique/30 text-gold-light text-xs hover:bg-gold-antique hover:text-oxblood-dark transition">Sign Out</button>
            </form>
        </div>
    </aside>

    <div class="flex-1 flex flex-col min-w-0">
        <header class="bg-oxblood-dark/95 border-b border-gold-antique/20 h-16 flex items-center justify-between px-4 sm:px-6 lg:px-8">
            <div class="flex items-center space-x-4">
                <button type="button" @click="sidebarOpen = true" class="md:hidden text-ivory-base hover:text-gold-light p-1">
                    <x-heroicon-o-bars-3 class="h-6 w-6" />
                </button>
                <div class="flex items-center space-x-2">
                    <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="font-serif text-xs sm:text-sm text-gold-light tracking-wider uppercase">Saddar Murshid Bazaar Master Terminal</span>
                </div>
            </div>
            <div class="flex items-center space-x-4 text-xs font-mono">
                <span class="text-gold-antique hidden sm:inline">1 Tola = 11.6638g</span>
                <a href="{{ route('admin.rates.index') }}" class="border border-gold-antique/40 px-2.5 py-1 text-[11px] text-gold-light hover:bg-gold-antique hover:text-oxblood-dark transition">Rates Console</a>
            </div>
        </header>

        <main class="flex-1 p-4 sm:p-6 lg:p-8 overflow-y-auto">
            @if(session('status'))
                <div class="mb-6 p-4 border border-gold-antique/40 bg-oxblood-dark text-gold-light text-xs flex items-center justify-between shadow-lg">
                    <span>{{ session('status') }}</span>
                    <span class="text-gold-antique font-mono">OK</span>
                </div>
            @endif

            {{ $slot }}
        </main>
    </div>

    <x-ui.notifications />
</body>
</html>
