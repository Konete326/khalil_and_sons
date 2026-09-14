<x-layouts.admin :title="($product->exists ? 'Edit ' . $product->title : 'New Masterpiece') . ' | Khalil & Sons'">
    <div x-data="{
        generating3D: false, progress3D: 0, modelUrl: '{{ $product->model_3d_url ? asset($product->model_3d_url) : '' }}',
        async triggerAI() {
            @if($product->exists)
            this.generating3D = true; this.progress3D = 20;
            let res = await (await fetch('{{ route('admin.products.generate3d', $product) }}', { method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') } })).json();
            let p = setInterval(async () => {
                let pr = await (await fetch(`/admin/products/{{ $product->id }}/poll-3d/${res.task_id}`)).json();
                this.progress3D = pr.progress || this.progress3D;
                if (pr.status === 'success' || pr.progress >= 100) { clearInterval(p); this.generating3D = false; if (pr.model_url) { this.modelUrl = pr.model_url; window.notify('3D Mesh generated and attached to product.', 'success'); } }
            }, 1200);
            @else
            window.notify('Save the product first before generating an AI 3D mesh.', 'info');
            @endif
        }
    }" class="max-w-5xl space-y-6">
        <div class="flex items-center justify-between border-b border-gold-antique/20 pb-4">
            <div>
                <h2 class="font-serif text-xl font-medium text-gold-light uppercase tracking-wider">{{ $product->exists ? 'Modify Masterpiece Specification' : 'Register New Masterpiece' }}</h2>
                <p class="text-xs text-gold-antique/80">Karachi Sarafa Certification • Weight Ledger & Dual CAD Studio</p>
            </div>
            <a href="{{ route('admin.products.index') }}" class="border border-gold-antique/30 px-3.5 py-1.5 text-xs text-ivory-base/80 hover:text-gold-light transition">&larr; Back to Inventory</a>
        </div>

        <form action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 text-xs font-sans">
            @csrf
            @if($product->exists) @method('PUT') @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border border-gold-antique/20 bg-[#121212] p-6 shadow-xl">
                <div class="space-y-4">
                    <div>
                        <label class="block text-[10px] uppercase tracking-wider text-gold-antique mb-1.5">Piece Title *</label>
                        <input type="text" name="title" value="{{ old('title', $product->title) }}" required class="w-full border border-gold-antique/30 bg-black/40 p-2.5 text-xs text-ivory-base focus:border-gold-antique focus:outline-none" />
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] uppercase tracking-wider text-gold-antique mb-1.5">Category *</label>
                            <select name="category_id" required class="w-full border border-gold-antique/30 bg-black/40 p-2.5 text-xs text-ivory-base focus:border-gold-antique focus:outline-none">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" @selected(old('category_id', $product->category_id) == $cat->id)>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] uppercase tracking-wider text-gold-antique mb-1.5">Gold Karat *</label>
                            <select name="karat" required class="w-full border border-gold-antique/30 bg-black/40 p-2.5 text-xs text-ivory-base focus:border-gold-antique focus:outline-none font-mono">
                                @foreach(['24K', '22K', '21K', '18K'] as $k)
                                    <option value="{{ $k }}" @selected(old('karat', $product->karat) === $k)>{{ $k }} Standard</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 font-mono">
                        <div>
                            <label class="block text-[10px] uppercase tracking-wider text-gold-antique mb-1.5">Gross Weight (Grams) *</label>
                            <input type="number" step="0.001" name="gross_weight_grams" value="{{ old('gross_weight_grams', $product->gross_weight_grams) }}" required class="w-full border border-gold-antique/30 bg-black/40 p-2.5 text-xs text-ivory-base" />
                        </div>
                        <div>
                            <label class="block text-[10px] uppercase tracking-wider text-gold-antique mb-1.5">Net Gold Weight (Grams) *</label>
                            <input type="number" step="0.001" name="net_gold_weight_grams" value="{{ old('net_gold_weight_grams', $product->net_gold_weight_grams) }}" required class="w-full border border-gold-antique/30 bg-black/40 p-2.5 text-xs text-ivory-base" />
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 font-mono">
                        <div>
                            <label class="block text-[10px] uppercase tracking-wider text-gold-antique mb-1.5">Making Charges (PKR) *</label>
                            <input type="number" step="0.01" name="making_charges" value="{{ old('making_charges', $product->making_charges ?? 45000) }}" required class="w-full border border-gold-antique/30 bg-black/40 p-2.5 text-xs text-ivory-base" />
                        </div>
                        <div>
                            <label class="block text-[10px] uppercase tracking-wider text-gold-antique mb-1.5">Gemstone Cost (PKR)</label>
                            <input type="number" step="0.01" name="gemstone_cost" value="{{ old('gemstone_cost', $product->gemstone_cost ?? 0) }}" class="w-full border border-gold-antique/30 bg-black/40 p-2.5 text-xs text-ivory-base" />
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] uppercase tracking-wider text-gold-antique mb-1.5">Stone & Craftsmanship Description</label>
                        <textarea name="stone_description" rows="2" class="w-full border border-gold-antique/30 bg-black/40 p-2.5 text-xs text-ivory-base focus:border-gold-antique focus:outline-none">{{ old('stone_description', $product->stone_description) }}</textarea>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-[10px] uppercase tracking-wider text-gold-antique mb-1.5">Product Photography (Multiple)</label>
                        <input type="file" name="images[]" multiple accept="image/*" class="w-full border border-gold-antique/30 bg-black/40 p-2 text-xs text-ivory-base" />
                        @if($product->images)
                            <div class="flex items-center gap-2 mt-2">
                                @foreach($product->images as $img)
                                    <img src="{{ $img }}" class="h-12 w-12 object-cover border border-gold-antique/30 rounded" />
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="border border-gold-antique/30 bg-black/50 p-4 space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="font-serif text-gold-light uppercase text-xs">Dual CAD / 3D Asset Studio</span>
                            <span class="text-[9px] font-mono text-gold-antique">GLB / GLTF / STL</span>
                        </div>
                        <div>
                            <label class="block text-[10px] uppercase text-ivory-base/70 mb-1">Direct Workshop CAD File Upload</label>
                            <input type="file" name="cad_file" accept=".glb,.gltf,.stl,.obj" class="w-full border border-gold-antique/30 bg-black/40 p-2 text-xs text-ivory-base" />
                        </div>
                        <div class="pt-2 border-t border-gold-antique/15 flex items-center justify-between gap-3">
                            <button type="button" @click="triggerAI()" :disabled="generating3D" class="flex items-center gap-1.5 border border-gold-antique/50 bg-gold-antique/10 hover:bg-gold-antique hover:text-oxblood-dark px-3 py-1.5 text-xs font-semibold text-gold-light uppercase tracking-wider transition">
                                <x-heroicon-o-sparkles class="h-4 w-4" />
                                <span x-text="generating3D ? 'AI Generating ' + progress3D + '%' : 'Generate 3D via AI'"></span>
                            </button>
                            <span class="text-[10px] text-ivory-base/50">Tripo3D generative pipeline</span>
                        </div>
                        <template x-if="modelUrl">
                            <div class="mt-2 aspect-video w-full bg-black border border-gold-antique/20 overflow-hidden relative">
                                <model-viewer :src="modelUrl" alt="CAD Preview" auto-rotate camera-controls shadow-intensity="1" class="w-full h-full"></model-viewer>
                                <span class="absolute bottom-1 right-2 text-[8px] font-mono bg-black/80 px-1.5 py-0.5 text-gold-light">Active 3D Attached</span>
                            </div>
                        </template>
                    </div>

                    <div class="flex items-center gap-6 pt-2">
                        <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $product->is_featured)) class="rounded bg-black border-gold-antique/40 text-gold-antique" /><span class="text-[11px] text-ivory-base">Featured Heirloom</span></label>
                        <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->exists ? $product->is_active : true)) class="rounded bg-black border-gold-antique/40 text-gold-antique" /><span class="text-[11px] text-ivory-base">Active in Shop</span></label>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <a href="{{ route('admin.products.index') }}" class="border border-gold-antique/40 px-5 py-2.5 text-xs uppercase font-semibold text-ivory-base/80 hover:text-gold-light transition">Cancel</a>
                <button type="submit" class="bg-gold-antique px-8 py-2.5 text-xs uppercase font-semibold tracking-widest text-oxblood-dark hover:bg-gold-light transition shadow-xl">{{ $product->exists ? 'Update Specification' : 'Save & Enter into Ledger' }}</button>
            </div>
        </form>
    </div>
</x-layouts.admin>
