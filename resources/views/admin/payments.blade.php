<x-layouts.admin :title="'Payment Methods & QR Settlement | Khalil & Sons'">
    <div class="space-y-8 max-w-5xl">
        <div class="border-b border-gold-antique/20 pb-4">
            <span class="text-[10px] font-mono uppercase tracking-[0.25em] text-gold-antique">Banking & Remittance Channels</span>
            <h2 class="font-serif text-2xl sm:text-3xl text-gold-light mt-1">Corporate Accounts & Raast Instant QR</h2>
        </div>

        <div class="space-y-6">
            @foreach($methods as $pm)
                <div class="border border-gold-antique/30 bg-oxblood-dark/90 p-6 shadow-2xl">
                    <div class="flex items-center justify-between border-b border-gold-antique/20 pb-3 mb-4">
                        <div class="flex items-center space-x-3">
                            <span class="h-2 w-2 rounded-full {{ $pm->is_active ? 'bg-emerald-500' : 'bg-red-500' }}"></span>
                            <h3 class="font-serif text-base text-gold-light uppercase tracking-wider">{{ $pm->title }}</h3>
                        </div>
                        <span class="text-[10px] font-mono uppercase text-gold-antique px-2 py-0.5 border border-gold-antique/30">{{ $pm->type }}</span>
                    </div>

                    <form action="{{ route('admin.payments.update', $pm) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs font-mono">
                        @csrf
                        <div>
                            <label class="block text-[10px] uppercase text-gold-antique mb-1">Display Title</label>
                            <input type="text" name="title" value="{{ $pm->title }}" required class="w-full border border-gold-antique/30 bg-black/40 p-2 text-ivory-base" />
                        </div>

                        <div>
                            <label class="block text-[10px] uppercase text-gold-antique mb-1">Bank / Channel Name</label>
                            <input type="text" name="bank_name" value="{{ $pm->bank_name }}" required class="w-full border border-gold-antique/30 bg-black/40 p-2 text-ivory-base" />
                        </div>

                        <div>
                            <label class="block text-[10px] uppercase text-gold-antique mb-1">Account Title</label>
                            <input type="text" name="account_name" value="{{ $pm->account_name }}" required class="w-full border border-gold-antique/30 bg-black/40 p-2 text-ivory-base" />
                        </div>

                        <div>
                            <label class="block text-[10px] uppercase text-gold-antique mb-1">Account / Raast ID</label>
                            <input type="text" name="account_number" value="{{ $pm->account_number }}" required class="w-full border border-gold-antique/30 bg-black/40 p-2 text-ivory-base" />
                        </div>

                        <div>
                            <label class="block text-[10px] uppercase text-gold-antique mb-1">IBAN (Optional)</label>
                            <input type="text" name="iban" value="{{ $pm->iban }}" class="w-full border border-gold-antique/30 bg-black/40 p-2 text-ivory-base" />
                        </div>

                        <div>
                            <label class="block text-[10px] uppercase text-gold-antique mb-1">SWIFT / BIC Code (Optional)</label>
                            <input type="text" name="swift_code" value="{{ $pm->swift_code }}" class="w-full border border-gold-antique/30 bg-black/40 p-2 text-ivory-base" />
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-[10px] uppercase text-gold-antique mb-1">Payment Instructions</label>
                            <textarea name="instructions" rows="2" class="w-full border border-gold-antique/30 bg-black/40 p-2 text-ivory-base font-sans">{{ $pm->instructions }}</textarea>
                        </div>

                        <div class="md:col-span-2 flex flex-col sm:flex-row items-center justify-between gap-4 pt-2 border-t border-gold-antique/15">
                            <div class="flex items-center space-x-4">
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="checkbox" name="is_active" value="1" {{ $pm->is_active ? 'checked' : '' }} class="border-gold-antique/40 bg-black text-gold-antique" />
                                    <span class="text-[11px] uppercase text-gold-light">Active for Customers</span>
                                </label>
                                <label class="border border-gold-antique/30 px-3 py-1.5 text-[10px] text-gold-antique hover:text-gold-light cursor-pointer">
                                    <span>Upload QR Code</span>
                                    <input type="file" name="qr_code" accept="image/*" class="hidden" />
                                </label>
                            </div>

                            <button type="submit" class="bg-gold-antique px-6 py-2 text-xs font-semibold uppercase tracking-wider text-oxblood-dark hover:bg-gold-light transition shadow-md">
                                Save Settings
                            </button>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</x-layouts.admin>
