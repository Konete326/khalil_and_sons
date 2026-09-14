<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Services\Tripo3DService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.form', ['categories' => $categories, 'product' => new Product()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateProduct($request);
        $data = $this->handleFiles($request, $validated);
        $data['slug'] = Str::slug($validated['title']) . '-' . Str::random(4);
        Product::create($data);
        return redirect()->route('admin.products.index')->with('status', 'Masterpiece created and entered into Saddar ledger.');
    }

    public function edit(Product $product): View
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.form', compact('categories', 'product'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $this->validateProduct($request);
        $data = $this->handleFiles($request, $validated, $product);
        if ($product->title !== $validated['title']) {
            $data['slug'] = Str::slug($validated['title']) . '-' . substr(md5((string)$product->id), 0, 4);
        }
        $product->update($data);
        return redirect()->route('admin.products.index')->with('status', 'Product specification and CAD updated.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('status', 'Product removed from collection.');
    }

    public function generate3D(Product $product, Tripo3DService $tripo): JsonResponse
    {
        $img = !empty($product->images[0]) ? url($product->images[0]) : null;
        $res = $tripo->createDraftModel("{$product->karat} gold luxury {$product->title}", $img);
        return response()->json($res);
    }

    public function poll3D(Product $product, string $taskId, Tripo3DService $tripo): JsonResponse
    {
        $res = $tripo->pollTaskStatus($taskId);
        if (($res['status'] ?? '') === 'success' && !empty($res['model_url'])) {
            $product->update(['model_3d_url' => $res['model_url']]);
        }
        return response()->json($res);
    }

    private function validateProduct(Request $request): array
    {
        return $request->validate([
            'category_id' => 'required|exists:categories,id', 'title' => 'required|string|max:255',
            'karat' => 'required|in:18K,21K,22K,24K', 'gross_weight_grams' => 'required|numeric|min:0.1',
            'net_gold_weight_grams' => 'required|numeric|min:0.1|lte:gross_weight_grams',
            'making_charges' => 'required|numeric|min:0', 'gemstone_cost' => 'nullable|numeric|min:0',
            'stone_description' => 'nullable|string', 'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'cad_file' => 'nullable|file|mimes:glb,gltf,stl,obj|max:51200',
        ]);
    }

    private function handleFiles(Request $request, array $validated, ?Product $product = null): array
    {
        $data = $validated;
        $data['gemstone_cost'] = $validated['gemstone_cost'] ?? 0;
        $data['is_featured'] = (bool)($validated['is_featured'] ?? false);
        $data['is_active'] = (bool)($validated['is_active'] ?? true);
        $existing = $product?->images ?? [];
        if ($request->hasFile('images')) {
            $newImgs = [];
            foreach ($request->file('images') as $f) {
                $name = 'prod_' . Str::random(32) . '.' . $f->extension();
                $f->move(public_path('assets/products'), $name);
                $newImgs[] = "/assets/products/{$name}";
            }
            $data['images'] = array_values(array_unique(array_merge($existing, $newImgs)));
        } else {
            $data['images'] = !empty($existing) ? $existing : ['/assets/products/choker-ruby-01.jpg'];
        }
        if ($request->hasFile('cad_file')) {
            $cad = $request->file('cad_file');
            $cName = 'cad_' . Str::random(32) . '.' . $cad->extension();
            $cad->move(public_path('assets/models'), $cName);
            $data['model_3d_url'] = "/assets/models/{$cName}";
        }
        return $data;
    }
}
