<header
    x-data="{ mobileMenuOpen: false, currency: 'PKR', currencyOpen: false }"
    class="relative w-full z-40 bg-oxblood-dark border-b border-gold-antique/20 text-ivory-base"
>
    <x-layouts.announcement-bar />

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 sm:h-20 items-center justify-between">
            <div class="flex items-center space-x-3">
                <button
                    type="button"
                    @click="mobileMenuOpen = true"
                    class="p-1 text-ivory-base hover:text-gold-light focus:outline-none lg:hidden"
                    aria-label="Open menu"
                >
                    <x-heroicon-o-bars-3 class="h-6 w-6" />
                </button>

                <a href="/" class="flex items-center space-x-2.5">
                    <img src="{{ asset('assets/logo.png') }}" alt="Khalil & Son's" class="h-8 w-8 sm:h-9 sm:w-9 object-contain" />
                    <div class="flex flex-col">
                        <span class="font-serif text-lg sm:text-xl font-medium tracking-[0.2em] text-gold-light">
                            KHALIL & SON'S
                        </span>
                        <span class="text-[9px] font-sans tracking-[0.25em] text-gold-antique uppercase">
                            Karachi • Since 1991
                        </span>
                    </div>
                </a>
            </div>

            <nav class="hidden lg:flex lg:items-center lg:space-x-8">
                <a href="{{ request()->routeIs('home') ? '#collections' : route('home') . '#collections' }}" class="text-xs font-medium tracking-widest uppercase transition {{ request()->routeIs('home') ? 'text-gold-light border-b border-gold-antique/60 pb-0.5' : 'text-ivory-base/85 hover:text-gold-light' }}">Collections</a>
                <a href="{{ route('bespoke') }}" class="text-xs font-medium tracking-widest uppercase transition {{ request()->routeIs('bespoke') ? 'text-gold-light border-b border-gold-antique/60 pb-0.5' : 'text-ivory-base/85 hover:text-gold-light' }}">Custom Atelier</a>
                <a href="{{ request()->routeIs('home') ? '#gold-rates' : route('home') . '#gold-rates' }}" class="text-xs font-medium tracking-widest uppercase transition text-ivory-base/85 hover:text-gold-light">Gold Rates</a>
                <a href="{{ route('about') }}" class="text-xs font-medium tracking-widest uppercase transition {{ request()->routeIs('about') ? 'text-gold-light border-b border-gold-antique/60 pb-0.5' : 'text-ivory-base/85 hover:text-gold-light' }}">About</a>
            </nav>

            <div class="flex items-center space-x-3 sm:space-x-5">
                <div class="relative" @click.outside="currencyOpen = false">
                    <button
                        type="button"
                        @click="currencyOpen = !currencyOpen"
                        class="flex items-center space-x-1 border border-gold-antique/40 px-2.5 py-1 text-xs font-medium tracking-wider text-ivory-base hover:border-gold-light hover:text-gold-light transition"
                    >
                        <span x-text="currency"></span>
                        <x-heroicon-m-chevron-down class="h-3.5 w-3.5 text-gold-antique" />
                    </button>
                    <div
                        x-show="currencyOpen"
                        x-cloak
                        class="absolute right-0 mt-2 w-28 border border-gold-antique/40 bg-oxblood-dark py-1 shadow-2xl z-50"
                    >
                        <template x-for="curr in ['PKR', 'USD', 'AED', 'GBP']" :key="curr">
                            <button
                                type="button"
                                @click="currency = curr; currencyOpen = false; window.notify('Currency set to ' + curr)"
                                class="block w-full px-4 py-1.5 text-left text-xs font-medium tracking-wider text-ivory-base hover:bg-gold-antique/20 hover:text-gold-light transition"
                                x-text="curr"
                            ></button>
                        </template>
                    </div>
                </div>

                <button
                    type="button"
                    @click="window.notify('Shopping bag: 0 items.')"
                    class="relative p-1 text-ivory-base/90 hover:text-gold-light transition"
                    aria-label="Shopping Bag"
                >
                    <x-heroicon-o-shopping-bag class="h-5 w-5" />
                    <span class="absolute -right-1 -top-1 flex h-4 w-4 items-center justify-center rounded-full bg-oxblood text-[9px] font-medium text-gold-light border border-gold-antique/40">
                        0
                    </span>
                </button>
            </div>
        </div>
    </div>

    <div
        x-show="mobileMenuOpen"
        x-cloak
        class="fixed inset-0 z-50 lg:hidden"
        aria-modal="true"
    >
        <div
            x-show="mobileMenuOpen"
            x-transition:enter="transition-opacity ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="mobileMenuOpen = false"
            class="fixed inset-0 bg-black/60 backdrop-blur-sm"
        ></div>

        <div
            x-show="mobileMenuOpen"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            class="relative flex h-full w-4/5 max-w-xs flex-col justify-between border-r border-gold-antique/30 bg-oxblood-dark p-6 shadow-2xl"
        >
            <div>
                <div class="flex items-center justify-between border-b border-gold-antique/20 pb-4">
                    <div class="flex flex-col">
                        <span class="font-serif text-base font-medium tracking-[0.2em] text-gold-light">KHALIL & SON'S</span>
                        <span class="text-[9px] tracking-[0.25em] text-gold-antique uppercase">Karachi • Since 1991</span>
                    </div>
                    <button
                        type="button"
                        @click="mobileMenuOpen = false"
                        class="p-1 text-ivory-base hover:text-gold-light"
                        aria-label="Close menu"
                    >
                        <x-heroicon-o-x-mark class="h-6 w-6" />
                    </button>
                </div>

                <nav class="mt-6 flex flex-col space-y-4">
                    <a href="{{ request()->routeIs('home') ? '#collections' : route('home') . '#collections' }}" @click="mobileMenuOpen = false" class="text-sm font-medium tracking-widest uppercase transition {{ request()->routeIs('home') ? 'text-gold-light font-semibold' : 'text-ivory-base hover:text-gold-light' }}">Collections</a>
                    <a href="{{ route('bespoke') }}" @click="mobileMenuOpen = false" class="text-sm font-medium tracking-widest uppercase transition {{ request()->routeIs('bespoke') ? 'text-gold-light font-semibold' : 'text-ivory-base hover:text-gold-light' }}">Custom Atelier</a>
                    <a href="{{ request()->routeIs('home') ? '#gold-rates' : route('home') . '#gold-rates' }}" @click="mobileMenuOpen = false" class="text-sm font-medium tracking-widest uppercase transition text-ivory-base hover:text-gold-light">Gold Rates</a>
                    <a href="{{ route('about') }}" @click="mobileMenuOpen = false" class="text-sm font-medium tracking-widest uppercase transition {{ request()->routeIs('about') ? 'text-gold-light font-semibold' : 'text-ivory-base hover:text-gold-light' }}">About</a>
                </nav>
            </div>

            <div class="border-t border-gold-antique/20 pt-4 text-center">
                <p class="text-[10px] uppercase tracking-widest text-gold-antique">Murshid Bazaar, Saddar, Karachi</p>
            </div>
        </div>
    </div>
</header>
