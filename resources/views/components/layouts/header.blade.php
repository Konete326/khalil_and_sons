<header
    x-data="{ mobileMenuOpen: false, currency: 'PKR', currencyOpen: false }"
    @currency-change.window="currency = $event.detail"
    class="relative w-full z-40 bg-oxblood-dark border-b border-gold-antique/20 text-ivory-base"
>
    <div class="mx-auto max-w-7xl xl:max-w-[1400px] px-4 sm:px-6 lg:px-8 xl:px-12">
        <div class="flex h-16 sm:h-20 items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center space-x-2.5 sm:space-x-3 group">
                <img src="{{ asset('assets/logo.png') }}" alt="Khalil & Son's" class="h-8 w-8 sm:h-9 sm:w-9 object-contain transition-transform group-hover:scale-105" />
                <div class="flex flex-col">
                    <span class="font-serif text-base sm:text-xl font-medium tracking-[0.18em] text-gold-light">KHALIL & SON'S</span>
                    <span class="hidden sm:inline text-[9px] font-sans tracking-[0.25em] text-gold-antique uppercase">Karachi • Since 1991</span>
                </div>
            </a>

            <nav class="hidden md:flex items-center space-x-6 lg:space-x-8">
                <a href="{{ request()->routeIs('home') ? '#collections' : route('home') . '#collections' }}" class="text-xs font-medium tracking-widest uppercase transition {{ request()->routeIs('home') ? 'text-gold-light border-b border-gold-antique/60 pb-0.5' : 'text-ivory-base/85 hover:text-gold-light' }}">Collections</a>
                <a href="{{ route('bespoke') }}" class="text-xs font-medium tracking-widest uppercase transition {{ request()->routeIs('bespoke') ? 'text-gold-light border-b border-gold-antique/60 pb-0.5' : 'text-ivory-base/85 hover:text-gold-light' }}">Custom Atelier</a>
                <a href="{{ route('gold.rates') }}" class="text-xs font-medium tracking-widest uppercase transition {{ request()->routeIs('gold.rates') ? 'text-gold-light border-b border-gold-antique/60 pb-0.5' : 'text-ivory-base/85 hover:text-gold-light' }}">Gold Rates</a>
                <a href="{{ route('about') }}" class="text-xs font-medium tracking-widest uppercase transition {{ request()->routeIs('about') ? 'text-gold-light border-b border-gold-antique/60 pb-0.5' : 'text-ivory-base/85 hover:text-gold-light' }}">About Atelier</a>
            </nav>

            <div class="flex items-center space-x-2.5 sm:space-x-4">
                <div class="relative" @click.outside="currencyOpen = false">
                    <button type="button" @click="currencyOpen = !currencyOpen" class="flex items-center space-x-1 border border-gold-antique/40 px-2 sm:px-2.5 py-1 text-[11px] sm:text-xs font-medium tracking-wider text-ivory-base hover:border-gold-light hover:text-gold-light transition">
                        <span x-text="currency"></span>
                        <x-heroicon-m-chevron-down class="h-3 sm:h-3.5 w-3 sm:w-3.5 text-gold-antique" />
                    </button>
                    <div x-show="currencyOpen" x-cloak class="absolute right-0 mt-2 w-28 border border-gold-antique/40 bg-oxblood-dark py-1 shadow-2xl z-50">
                        <template x-for="curr in ['PKR', 'USD', 'AED', 'SAR', 'GBP']" :key="curr">
                            <button type="button" @click="currency = curr; currencyOpen = false; $dispatch('currency-change', curr); window.notify('Currency set to ' + curr)" class="block w-full px-4 py-1.5 text-left text-xs font-medium tracking-wider text-ivory-base hover:bg-gold-antique/20 hover:text-gold-light transition" x-text="curr"></button>
                        </template>
                    </div>
                </div>

                @auth
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="hidden sm:inline-flex border border-gold-antique bg-gold-antique/20 hover:bg-gold-antique hover:text-oxblood-dark px-3 py-1 text-[11px] font-semibold uppercase tracking-wider text-gold-light transition">Portal</a>
                    @else
                        <a href="{{ route('account') }}" class="hidden sm:inline-flex border border-gold-antique/40 px-3 py-1 text-[11px] font-medium uppercase tracking-wider text-gold-light hover:border-gold-light transition">Salon</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="hidden sm:inline-flex border border-gold-antique/40 px-3 py-1 text-[11px] font-medium uppercase tracking-wider text-ivory-base hover:text-gold-light hover:border-gold-light transition">Sign In</a>
                @endauth

                <button type="button" @click="window.customConfirm('Would you like to reserve a private viewing salon in Murshid Bazaar?', () => window.notify('Private salon consultation reserved with master goldsmiths.', 'success'), 'Private Salon')" class="hidden lg:inline-flex border border-gold-antique/60 bg-gold-antique/10 hover:bg-gold-antique hover:text-oxblood-dark px-3.5 py-1 text-[11px] font-semibold uppercase tracking-widest text-gold-light transition">
                    Book Salon
                </button>

                <button type="button" @click="mobileMenuOpen = true" class="p-1 text-ivory-base hover:text-gold-light focus:outline-none md:hidden" aria-label="Open navigation menu">
                    <x-heroicon-o-bars-3 class="h-6 w-6" />
                </button>
            </div>
        </div>
    </div>

    <div x-show="mobileMenuOpen" x-cloak class="fixed inset-0 z-50 md:hidden" aria-modal="true">
        <div x-show="mobileMenuOpen" x-transition:enter="transition-opacity ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="mobileMenuOpen = false" class="fixed inset-0 bg-black/80 backdrop-blur-sm"></div>

        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" class="fixed top-0 right-0 bottom-0 flex h-full w-[85vw] max-w-sm flex-col justify-between border-l border-gold-antique/40 bg-oxblood-dark p-6 shadow-2xl z-10 overflow-y-auto">
            <div>
                <div class="flex items-center justify-between border-b border-gold-antique/30 pb-4">
                    <div class="flex items-center space-x-2.5">
                        <img src="{{ asset('assets/logo.png') }}" alt="Khalil & Son's" class="h-7 w-7 object-contain" />
                        <div class="flex flex-col">
                            <span class="font-serif text-sm font-medium tracking-[0.2em] text-gold-light">KHALIL & SON'S</span>
                            <span class="text-[8px] tracking-[0.25em] text-gold-antique uppercase">Karachi • Since 1991</span>
                        </div>
                    </div>
                    <button type="button" @click="mobileMenuOpen = false" class="p-1 text-ivory-base hover:text-gold-light" aria-label="Close menu">
                        <x-heroicon-o-x-mark class="h-6 w-6" />
                    </button>
                </div>

                <nav class="mt-6 flex flex-col space-y-3 font-serif">
                    <a href="{{ request()->routeIs('home') ? '#collections' : route('home') . '#collections' }}" @click="mobileMenuOpen = false" class="text-sm tracking-widest uppercase transition py-2 border-b border-gold-antique/15 {{ request()->routeIs('home') ? 'text-gold-light font-semibold' : 'text-ivory-base hover:text-gold-light' }}">Collections</a>
                    <a href="{{ route('bespoke') }}" @click="mobileMenuOpen = false" class="text-sm tracking-widest uppercase transition py-2 border-b border-gold-antique/15 {{ request()->routeIs('bespoke') ? 'text-gold-light font-semibold' : 'text-ivory-base hover:text-gold-light' }}">Custom Atelier</a>
                    <a href="{{ route('gold.rates') }}" @click="mobileMenuOpen = false" class="text-sm tracking-widest uppercase transition py-2 border-b border-gold-antique/15 {{ request()->routeIs('gold.rates') ? 'text-gold-light font-semibold' : 'text-ivory-base hover:text-gold-light' }}">Live Gold Rates</a>
                    <a href="{{ route('about') }}" @click="mobileMenuOpen = false" class="text-sm tracking-widest uppercase transition py-2 border-b border-gold-antique/15 {{ request()->routeIs('about') ? 'text-gold-light font-semibold' : 'text-ivory-base hover:text-gold-light' }}">About Atelier</a>
                    @auth
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" @click="mobileMenuOpen = false" class="text-sm tracking-widest uppercase transition py-2 border-b border-gold-antique/15 text-gold-light font-semibold">Workshop Portal &rarr;</a>
                        @else
                            <a href="{{ route('account') }}" @click="mobileMenuOpen = false" class="text-sm tracking-widest uppercase transition py-2 border-b border-gold-antique/15 text-gold-light font-semibold">My Salon & Orders</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" @click="mobileMenuOpen = false" class="text-sm tracking-widest uppercase transition py-2 border-b border-gold-antique/15 text-gold-light font-semibold">Patron Sign In</a>
                    @endauth
                </nav>

                <div class="mt-8">
                    <button type="button" @click="mobileMenuOpen = false; window.customConfirm('Would you like to schedule a private bridal suite viewing at our Murshid Bazaar showroom?', () => window.notify('Private consultation reserved with our master goldsmiths.', 'success'), 'Private Consultation')" class="w-full bg-gold-antique py-3 text-center text-xs font-semibold uppercase tracking-[0.2em] text-oxblood-dark shadow-xl transition hover:bg-gold-light">
                        Book Private Salon Viewing
                    </button>
                </div>
            </div>

            <div class="border-t border-gold-antique/30 pt-6 space-y-4">
                <a href="https://wa.me/923001234567?text=Assalam-o-Alaikum%20Khalil%20%26%20Sons%2C%20I%20would%20like%20to%20inquire%20about%20a%20private%20bridal%20consultation." target="_blank" rel="noopener noreferrer" class="flex items-center justify-center gap-2 border border-[#25D366]/40 bg-[#25D366]/10 px-4 py-2.5 text-xs text-[#25D366] hover:bg-[#25D366] hover:text-black transition">
                    <span>WhatsApp VIP Concierge</span>
                </a>
                <div class="text-center">
                    <p class="text-[10px] uppercase tracking-widest text-gold-antique">Murshid Bazaar, Saddar, Karachi</p>
                    <p class="text-[9px] text-ivory-base/60 mt-0.5">Sarafa Hallmark Certified • Mon - Sat</p>
                </div>
            </div>
        </div>
    </div>
</header>
