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
<body class="min-h-screen bg-[#0a0a0a] text-ivory-base font-sans antialiased flex" x-data="{ sidebarOpen: true, mobileOpen: false }">
    <div x-show="mobileOpen" x-cloak class="fixed inset-0 z-40 bg-black/80 backdrop-blur-sm md:hidden" @click="mobileOpen = false"></div>

    <aside :class="mobileOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 md:hidden flex flex-col justify-between w-64 bg-[#111111] border-r border-gold-antique/20 transition-transform duration-300 ease-in-out p-6 overflow-y-auto min-h-screen">
        <div>
            <div class="flex items-center justify-between border-b border-gold-antique/20 pb-4">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('assets/logo.png') }}" alt="Khalil & Sons" class="h-8 w-8 object-contain" />
                    <div>
                        <h1 class="font-serif text-sm font-semibold tracking-[0.18em] text-gold-light uppercase">Khalil & Sons</h1>
                        <p class="text-[9px] font-sans tracking-widest text-gold-antique uppercase">Sarafa Atelier Portal</p>
                    </div>
                </div>
                <button type="button" @click="mobileOpen = false" class="text-ivory-base/70 hover:text-gold-light p-1">
                    <x-heroicon-o-x-mark class="h-5 w-5" />
                </button>
            </div>
            <nav class="mt-6 space-y-1.5 font-serif text-xs">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded transition {{ request()->routeIs('admin.dashboard') ? 'bg-gold-antique text-oxblood-dark font-semibold' : 'text-ivory-base/80 hover:bg-gold-antique/10 hover:text-gold-light' }}"><x-heroicon-o-home class="h-4 w-4" /><span>Overview</span></a>
                <a href="{{ route('admin.orders.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded transition {{ request()->routeIs('admin.orders.*') ? 'bg-gold-antique text-oxblood-dark font-semibold' : 'text-ivory-base/80 hover:bg-gold-antique/10 hover:text-gold-light' }}"><x-heroicon-o-clipboard-document-check class="h-4 w-4" /><span>Orders & Slips</span></a>
                <a href="{{ route('admin.rates.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded transition {{ request()->routeIs('admin.rates.*') ? 'bg-gold-antique text-oxblood-dark font-semibold' : 'text-ivory-base/80 hover:bg-gold-antique/10 hover:text-gold-light' }}"><x-heroicon-o-currency-dollar class="h-4 w-4" /><span>Sarafa Metal Rates</span></a>
                <a href="{{ route('admin.payments.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded transition {{ request()->routeIs('admin.payments.*') ? 'bg-gold-antique text-oxblood-dark font-semibold' : 'text-ivory-base/80 hover:bg-gold-antique/10 hover:text-gold-light' }}"><x-heroicon-o-building-library class="h-4 w-4" /><span>Payment Methods</span></a>
                <a href="{{ route('home') }}" target="_blank" class="flex items-center space-x-3 px-3.5 py-2.5 rounded text-gold-antique hover:text-gold-light transition mt-6 pt-4 border-t border-gold-antique/15"><x-heroicon-o-arrow-top-right-on-square class="h-4 w-4" /><span>View Storefront</span></a>
            </nav>
        </div>
        <div class="border-t border-gold-antique/20 pt-4 text-xs">
            <div class="mb-3">
                <p class="text-[10px] uppercase tracking-widest text-gold-antique">Active Administrator</p>
                <p class="font-serif text-gold-light truncate">{{ auth()->user()?->name ?? 'Administrator' }}</p>
                <p class="text-[10px] text-ivory-base/50 truncate font-mono">{{ auth()->user()?->email }}</p>
            </div>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-left px-3 py-2 border border-gold-antique/30 text-gold-light text-xs hover:bg-gold-antique hover:text-oxblood-dark transition rounded">Sign Out</button>
            </form>
        </div>
    </aside>

    <aside :class="sidebarOpen ? 'w-64 translate-x-0 p-6' : 'w-0 -translate-x-full overflow-hidden p-0 border-r-0'" class="hidden md:flex flex-col justify-between bg-[#111111] border-r border-gold-antique/20 transition-all duration-300 ease-in-out flex-shrink-0 min-h-screen">
        <div>
            <div class="flex items-center space-x-3 border-b border-gold-antique/20 pb-4">
                <img src="{{ asset('assets/logo.png') }}" alt="Khalil & Sons" class="h-8 w-8 object-contain" />
                <div class="whitespace-nowrap">
                    <h1 class="font-serif text-sm font-semibold tracking-[0.18em] text-gold-light uppercase">Khalil & Sons</h1>
                    <p class="text-[9px] font-sans tracking-widest text-gold-antique uppercase">Sarafa Atelier Portal</p>
                </div>
            </div>
            <nav class="mt-6 space-y-1.5 font-serif text-xs whitespace-nowrap">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded transition {{ request()->routeIs('admin.dashboard') ? 'bg-gold-antique text-oxblood-dark font-semibold' : 'text-ivory-base/80 hover:bg-gold-antique/10 hover:text-gold-light' }}"><x-heroicon-o-home class="h-4 w-4" /><span>Overview</span></a>
                <a href="{{ route('admin.orders.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded transition {{ request()->routeIs('admin.orders.*') ? 'bg-gold-antique text-oxblood-dark font-semibold' : 'text-ivory-base/80 hover:bg-gold-antique/10 hover:text-gold-light' }}"><x-heroicon-o-clipboard-document-check class="h-4 w-4" /><span>Orders & Slips</span></a>
                <a href="{{ route('admin.rates.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded transition {{ request()->routeIs('admin.rates.*') ? 'bg-gold-antique text-oxblood-dark font-semibold' : 'text-ivory-base/80 hover:bg-gold-antique/10 hover:text-gold-light' }}"><x-heroicon-o-currency-dollar class="h-4 w-4" /><span>Sarafa Metal Rates</span></a>
                <a href="{{ route('admin.payments.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded transition {{ request()->routeIs('admin.payments.*') ? 'bg-gold-antique text-oxblood-dark font-semibold' : 'text-ivory-base/80 hover:bg-gold-antique/10 hover:text-gold-light' }}"><x-heroicon-o-building-library class="h-4 w-4" /><span>Payment Methods</span></a>
                <a href="{{ route('home') }}" target="_blank" class="flex items-center space-x-3 px-3.5 py-2.5 rounded text-gold-antique hover:text-gold-light transition mt-6 pt-4 border-t border-gold-antique/15"><x-heroicon-o-arrow-top-right-on-square class="h-4 w-4" /><span>View Storefront</span></a>
            </nav>
        </div>
        <div class="border-t border-gold-antique/20 pt-4 text-xs whitespace-nowrap">
            <div class="mb-3">
                <p class="text-[10px] uppercase tracking-widest text-gold-antique">Active Administrator</p>
                <p class="font-serif text-gold-light truncate">{{ auth()->user()?->name ?? 'Administrator' }}</p>
                <p class="text-[10px] text-ivory-base/50 truncate font-mono">{{ auth()->user()?->email }}</p>
            </div>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-left px-3 py-2 border border-gold-antique/30 text-gold-light text-xs hover:bg-gold-antique hover:text-oxblood-dark transition rounded">Sign Out</button>
            </form>
        </div>
    </aside>

    <div class="flex-1 flex flex-col min-w-0 bg-[#0a0a0a]">
        <header class="sticky top-0 z-30 bg-[#111111]/95 border-b border-gold-antique/20 h-16 flex items-center justify-between px-6 lg:px-10 backdrop-blur-md">
            <div class="flex items-center space-x-4">
                <button type="button" @click="mobileOpen = true" class="md:hidden text-ivory-base hover:text-gold-light p-1.5 border border-gold-antique/30 bg-black/40 rounded">
                    <x-heroicon-o-bars-3 class="h-5 w-5" />
                </button>
                <button type="button" @click="sidebarOpen = !sidebarOpen" class="hidden md:inline-flex text-ivory-base/80 hover:text-gold-light p-1.5 border border-gold-antique/30 bg-[#161616] hover:bg-gold-antique/20 rounded transition" title="Toggle Sidebar">
                    <x-heroicon-o-bars-3-bottom-left class="h-5 w-5 text-gold-antique" />
                </button>
                <div class="flex items-center space-x-2">
                    <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="font-serif text-xs sm:text-sm text-gold-light tracking-wider uppercase truncate">Saddar Murshid Bazaar Master Terminal</span>
                </div>
            </div>
            <div class="flex items-center space-x-4 text-xs font-mono">
                <span class="text-gold-antique hidden lg:inline">1 Tola = 11.6638g</span>
                <a href="{{ route('admin.rates.index') }}" class="border border-gold-antique/40 px-2.5 py-1 text-[11px] text-gold-light hover:bg-gold-antique hover:text-oxblood-dark transition rounded">Rates Console</a>
            </div>
        </header>

        <main class="flex-1 w-full px-6 py-6 lg:px-10 overflow-y-auto">
            @if(session('status'))
                <div class="mb-6 p-4 border border-gold-antique/40 bg-[#121212] text-gold-light text-xs flex items-center justify-between shadow-lg rounded-lg">
                    <span>{{ session('status') }}</span>
                    <span class="text-gold-antique font-mono">OK</span>
                </div>
            @endif

            <div class="w-full">
                {{ $slot }}
            </div>
        </main>
    </div>

    <x-ui.notifications />
</body>
</html>
