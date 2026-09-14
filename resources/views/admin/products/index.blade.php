<x-layouts.admin :title="'Product Catalog & CAD Studio | Khalil & Sons'">
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-gold-antique/20 pb-4">
            <div>
                <h2 class="font-serif text-xl font-medium text-gold-light uppercase tracking-wider">Product Inventory & 3D Assets</h2>
                <p class="text-xs text-gold-antique/80">Murshid Bazaar Atelier Master Ledger • Weight & Gemstone Specifications</p>
            </div>
            <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 bg-gold-antique px-4 py-2 text-xs font-semibold uppercase tracking-wider text-oxblood-dark hover:bg-gold-light transition shadow-lg">
                <x-heroicon-m-plus class="h-4 w-4" />
                <span>New Masterpiece</span>
            </a>
        </div>

        <div class="overflow-x-auto border border-gold-antique/20 bg-[#121212] shadow-2xl">
            <table class="w-full text-left text-xs text-ivory-base/90">
                <thead class="border-b border-gold-antique/30 bg-[#181818] font-serif uppercase tracking-widest text-[10px] text-gold-light">
                    <tr>
                        <th class="p-3.5">Piece</th>
                        <th class="p-3.5">Category & Karat</th>
                        <th class="p-3.5">Gold Weights</th>
                        <th class="p-3.5">Making & Gems</th>
                        <th class="p-3.5">CAD / 3D Status</th>
                        <th class="p-3.5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gold-antique/10">
                    @forelse($products as $p)
                        <tr class="hover:bg-gold-antique/5 transition">
                            <td class="p-3.5">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $p->images[0] ?? asset('assets/products/choker-ruby-01.jpg') }}" alt="{{ $p->title }}" class="h-12 w-12 object-cover border border-gold-antique/30 rounded bg-black" />
                                    <div>
                                        <p class="font-serif text-sm text-gold-light font-medium line-clamp-1">{{ $p->title }}</p>
                                        <p class="text-[10px] text-ivory-base/50 font-mono">{{ $p->slug }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-3.5 font-mono">
                                <p class="text-gold-antique">{{ $p->category?->name ?? 'Uncategorized' }}</p>
                                <span class="inline-block mt-0.5 px-2 py-0.5 border border-gold-antique/40 text-[9px] bg-black/40 text-gold-light font-semibold">{{ $p->karat }}</span>
                            </td>
                            <td class="p-3.5 font-mono text-[11px]">
                                <div>Gross: <span class="text-gold-light font-bold">{{ number_format($p->gross_weight_grams, 2) }}g</span></div>
                                <div class="text-ivory-base/60">Net Gold: {{ number_format($p->net_gold_weight_grams, 2) }}g</div>
                            </td>
                            <td class="p-3.5 font-mono text-[11px]">
                                <div>Making: Rs. {{ number_format($p->making_charges) }}</div>
                                <div class="text-ivory-base/60">Gems: Rs. {{ number_format($p->gemstone_cost) }}</div>
                            </td>
                            <td class="p-3.5">
                                @if($p->model_3d_url)
                                    <div class="inline-flex items-center gap-1 px-2 py-1 border border-emerald-500/40 bg-emerald-950/40 text-emerald-300 text-[10px] font-mono">
                                        <x-heroicon-m-cube class="h-3.5 w-3.5 text-emerald-400" />
                                        <span>{{ str_contains($p->model_3d_url, 'cad_') ? 'Direct CAD' : '3D Ready' }}</span>
                                    </div>
                                @else
                                    <span class="inline-block px-2 py-0.5 border border-ivory-base/20 text-[10px] text-ivory-base/40 font-mono">No 3D</span>
                                @endif
                            </td>
                            <td class="p-3.5 text-right space-x-2 whitespace-nowrap">
                                <a href="{{ route('admin.products.edit', $p) }}" class="inline-block px-2.5 py-1 border border-gold-antique/40 text-[10px] uppercase font-semibold text-gold-light hover:bg-gold-antique hover:text-oxblood-dark transition">Edit</a>
                                <form action="{{ route('admin.products.destroy', $p) }}" method="POST" class="inline-block" onsubmit="return confirm('Remove this masterpiece from collection?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2.5 py-1 border border-red-500/30 text-[10px] uppercase text-red-400 hover:bg-red-900/30 transition">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="p-8 text-center text-ivory-base/50">No masterpieces currently found in inventory.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $products->links() }}</div>
    </div>
</x-layouts.admin>
