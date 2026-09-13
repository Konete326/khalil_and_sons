@props([
    'address' => 'Shop # 14-16, Murshid Bazaar, Saddar, Karachi, Pakistan',
    'timing' => 'Mon – Sat: 11:30 AM – 8:30 PM (Fri: Closed 1:00 – 2:30 PM)',
    'phone' => '+92 (21) 3568-7491',
    'email' => 'concierge@khalilandsons.com'
])

<footer class="border-t border-gold-antique/30 bg-oxblood-dark text-ivory-base">
    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-12 lg:grid-cols-4">
            <div class="space-y-6">
                <div class="flex items-center space-x-3">
                    <span class="flex h-10 w-10 items-center justify-center border border-gold-antique bg-oxblood text-sm font-serif font-bold text-gold-light">
                        K&S
                    </span>
                    <div class="flex flex-col">
                        <span class="font-serif text-lg tracking-[0.2em] text-gold-light uppercase">
                            Khalil & Sons
                        </span>
                        <span class="text-[9px] tracking-[0.3em] text-gold-antique uppercase">
                            Heritage Jewellers • Since 1991
                        </span>
                    </div>
                </div>
                <p class="font-sans text-xs leading-relaxed text-ivory-base/70">
                    Over three decades of artisanal master goldsmithing, curating 22K/24K heritage bridal heirlooms, certified diamond solitaires, and uncut polki masterpieces.
                </p>
                <div class="pt-2">
                    <span class="inline-flex items-center space-x-2 border border-gold-antique/30 px-3 py-1.5 text-[10px] uppercase tracking-widest text-gold-light">
                        <x-heroicon-m-check-badge class="h-3.5 w-3.5 text-gold-antique" />
                        <span>100% Certified Hallmark Guarantee</span>
                    </span>
                </div>
            </div>

            <div class="space-y-4">
                <h4 class="font-serif text-sm tracking-[0.25em] text-gold-antique uppercase">Flagship Showroom</h4>
                <div class="space-y-3 text-xs leading-relaxed text-ivory-base/80">
                    <div class="flex items-start space-x-2">
                        <x-heroicon-o-map-pin class="h-4 w-4 text-gold-antique flex-shrink-0 mt-0.5" />
                        <span>{{ $address }}</span>
                    </div>
                    <div class="flex items-start space-x-2">
                        <x-heroicon-o-clock class="h-4 w-4 text-gold-antique flex-shrink-0 mt-0.5" />
                        <span>{{ $timing }}</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <x-heroicon-o-phone class="h-4 w-4 text-gold-antique flex-shrink-0" />
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" class="hover:text-gold-light transition">{{ $phone }}</a>
                    </div>
                    <div class="flex items-center space-x-2">
                        <x-heroicon-o-envelope class="h-4 w-4 text-gold-antique flex-shrink-0" />
                        <a href="mailto:{{ $email }}" class="hover:text-gold-light transition">{{ $email }}</a>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <h4 class="font-serif text-sm tracking-[0.25em] text-gold-antique uppercase">Atelier & Services</h4>
                <ul class="space-y-2.5 text-xs text-ivory-base/75">
                    <li><a href="#bespoke" class="hover:text-gold-light transition">Bespoke Bridal Commissioning</a></li>
                    <li><a href="#polki" class="hover:text-gold-light transition">Authentic Polki & Kundan Restoration</a></li>
                    <li><a href="#solitaires" class="hover:text-gold-light transition">GIA Certified Diamonds</a></li>
                    <li><a href="#hallmark" class="hover:text-gold-light transition">Hallmark Purity Verification</a></li>
                    <li><a href="#heritage" class="hover:text-gold-light transition">Heritage Archive Since 1991</a></li>
                </ul>
            </div>

            <div class="space-y-4" x-data="{ emailInput: '' }">
                <h4 class="font-serif text-sm tracking-[0.25em] text-gold-antique uppercase">Private Invitations</h4>
                <p class="font-sans text-xs leading-relaxed text-ivory-base/70">
                    Subscribe for exclusive previews of private collections, high jewellery exhibitions, and bridal previews.
                </p>
                <form
                    @submit.prevent="if(emailInput) { window.notify('Thank you. You have been enrolled in our private salon registry.', 'success'); emailInput = ''; }"
                    class="space-y-2"
                >
                    <div class="flex flex-col sm:flex-row gap-2">
                        <input
                            type="email"
                            x-model="emailInput"
                            placeholder="Enter your email"
                            required
                            class="w-full border border-gold-antique/40 bg-oxblood px-3.5 py-2.5 text-xs text-ivory-base placeholder-ivory-base/40 focus:border-gold-antique focus:outline-none focus:ring-1 focus:ring-gold-antique"
                        />
                        <button
                            type="submit"
                            class="bg-gold-antique px-5 py-2.5 text-xs font-semibold uppercase tracking-widest text-oxblood-dark hover:bg-gold-light transition flex-shrink-0"
                        >
                            Join
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-14 flex flex-col items-center justify-between border-t border-gold-antique/20 pt-8 sm:flex-row text-[11px] tracking-widest text-ivory-base/50 uppercase">
            <p>&copy; {{ date('Y') }} Khalil & Sons Jewellers. All Rights Reserved.</p>
            <div class="mt-4 sm:mt-0 flex space-x-6">
                <span>Murshid Bazaar, Saddar Karachi</span>
                <span class="text-gold-antique/40">•</span>
                <span>Hallmark Certified 22K/24K</span>
            </div>
        </div>
    </div>
</footer>
