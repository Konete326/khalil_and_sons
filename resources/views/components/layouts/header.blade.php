<header
    x-data="{ mobileMenuOpen: false, currency: 'PKR', currencyOpen: false }"
    class="relative w-full z-40 bg-oxblood-dark border-b border-gold-antique/20 text-ivory-base"
>
    <x-layouts.announcement-bar />

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 sm:h-20 items-center justify-between">
            <div class="flex items-center space-x-6 lg:hidden">
                <button
                    type="button"
                    @click="mobileMenuOpen = !mobileMenuOpen"
                    class="text-ivory-base hover:text-gold-light focus:outline-none"
                    aria-label="Toggle Navigation Menu"
                >
                    <x-heroicon-o-bars-3 class="h-6 w-6" />
                </button>
                <div class="relative" @click.outside="currencyOpen = false">
                    <button
                        type="button"
                        @click="currencyOpen = !currencyOpen"
                        class="flex items-center space-x-1 text-xs font-medium tracking-widest text-ivory-base/80 hover:text-gold-light"
                    >
                        <span x-text="currency"></span>
                        <x-heroicon-m-chevron-down class="h-3.5 w-3.5 text-gold-antique" />
                    </button>
                    <div
                        x-show="currencyOpen"
                        x-cloak
                        class="absolute left-0 mt-2 w-24 border border-gold-antique/40 bg-oxblood-dark/95 py-1 shadow-2xl backdrop-blur-md z-50"
                    >
                        <template x-for="curr in ['PKR', 'USD', 'AED', 'GBP']" :key="curr">
                            <button
                                type="button"
                                @click="currency = curr; currencyOpen = false; window.notify('Currency updated to ' + curr)"
                                class="block w-full px-3 py-1 text-left text-xs font-medium tracking-widest text-ivory-base hover:bg-gold-antique/20 hover:text-gold-light"
                                x-text="curr"
                            ></button>
                        </template>
                    </div>
                </div>
            </div>

            <nav class="hidden lg:flex lg:items-center lg:space-x-8">
                <a href="#high-jewellery" class="text-xs font-medium tracking-widest uppercase text-ivory-base/85 transition hover:text-gold-light">High Jewellery</a>
                <a href="#bridal" class="text-xs font-medium tracking-widest uppercase text-ivory-base/85 transition hover:text-gold-light">Bridal Suites</a>
                <a href="#polki-kundan" class="text-xs font-medium tracking-widest uppercase text-ivory-base/85 transition hover:text-gold-light">Polki & Kundan</a>
                <a href="#bespoke" class="text-xs font-medium tracking-widest uppercase text-ivory-base/85 transition hover:text-gold-light">Bespoke</a>
            </nav>

            <div class="flex flex-col items-center justify-center text-center">
                <a href="/" class="group flex flex-col items-center">
                    <div class="flex items-center space-x-2.5">
                        <img src="{{ asset('assets/logo.png') }}" alt="Khalil & Sons Logo" class="h-8 w-8 sm:h-9 sm:w-9 object-contain rounded shadow-sm" />
                        <span class="font-serif text-xl tracking-[0.25em] text-gold-light sm:text-2xl">
                            KHALIL & SONS
                        </span>
                    </div>
                    <span class="mt-0.5 text-[9px] font-medium tracking-[0.35em] text-gold-antique uppercase">
                        Since 1991 • Murshid Bazaar Saddar
                    </span>
                </a>
            </div>

            <div class="flex items-center space-x-4 sm:space-x-6">
                <div class="relative hidden lg:block" @click.outside="currencyOpen = false">
                    <button
                        type="button"
                        @click="currencyOpen = !currencyOpen"
                        class="flex items-center space-x-1.5 border border-gold-antique/40 px-2.5 py-1 text-xs font-medium tracking-widest text-ivory-base/90 hover:border-gold-light hover:text-gold-light transition"
                    >
                        <span x-text="currency"></span>
                        <x-heroicon-m-chevron-down class="h-3.5 w-3.5 text-gold-antique" />
                    </button>
                    <div
                        x-show="currencyOpen"
                        x-cloak
                        class="absolute right-0 mt-2 w-28 border border-gold-antique/40 bg-oxblood-dark/95 py-1 shadow-2xl z-50 backdrop-blur-md"
                    >
                        <template x-for="curr in ['PKR', 'USD', 'AED', 'GBP']" :key="curr">
                            <button
                                type="button"
                                @click="currency = curr; currencyOpen = false; window.notify('Currency updated to ' + curr)"
                                class="block w-full px-4 py-1.5 text-left text-xs font-medium tracking-widest text-ivory-base hover:bg-gold-antique/20 hover:text-gold-light transition"
                                x-text="curr"
                            ></button>
                        </template>
                    </div>
                </div>

                <button
                    type="button"
                    @click="window.customAlert('Concierge Search will be available in the catalogue module.', 'Search Atelier')"
                    class="text-ivory-base/80 transition hover:text-gold-light"
                    aria-label="Search Collection"
                >
                    <x-heroicon-o-magnifying-glass class="h-5 w-5" />
                </button>

                <button
                    type="button"
                    @click="window.notify('Wishlist feature connected to luxury vault.')"
                    class="text-ivory-base/80 transition hover:text-gold-light"
                    aria-label="Private Wishlist"
                >
                    <x-heroicon-o-heart class="h-5 w-5" />
                </button>

                <button
                    type="button"
                    @click="window.notify('Shopping Bag: 0 Heritage items selected.')"
                    class="relative text-ivory-base/80 transition hover:text-gold-light"
                    aria-label="Shopping Bag"
                >
                    <x-heroicon-o-shopping-bag class="h-5 w-5" />
                    <span class="absolute -right-2 -top-1 flex h-4 w-4 items-center justify-center rounded-full bg-oxblood text-[9px] font-medium text-gold-light border border-gold-antique/40">
                        0
                    </span>
                </button>
            </div>
        </div>
    </div>

    <div
        x-show="mobileMenuOpen"
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="border-b border-gold-antique/30 bg-oxblood-dark px-6 py-6 lg:hidden"
    >
        <div class="flex flex-col space-y-4">
            <a href="#high-jewellery" @click="mobileMenuOpen = false" class="text-sm font-medium tracking-widest uppercase text-ivory-base hover:text-gold-light">High Jewellery</a>
            <a href="#bridal" @click="mobileMenuOpen = false" class="text-sm font-medium tracking-widest uppercase text-ivory-base hover:text-gold-light">Bridal Suites</a>
            <a href="#polki-kundan" @click="mobileMenuOpen = false" class="text-sm font-medium tracking-widest uppercase text-ivory-base hover:text-gold-light">Polki & Kundan</a>
            <a href="#bespoke" @click="mobileMenuOpen = false" class="text-sm font-medium tracking-widest uppercase text-ivory-base hover:text-gold-light">Bespoke Atelier</a>
            <a href="#heritage" @click="mobileMenuOpen = false" class="text-sm font-medium tracking-widest uppercase text-ivory-base hover:text-gold-light">The Heritage</a>
        </div>
    </div>
</header>
