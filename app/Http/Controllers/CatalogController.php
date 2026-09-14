<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Currency;
use App\Models\Product;
use App\Services\JewelleryPricingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CatalogController extends Controller
{
    public function __construct(
        protected JewelleryPricingService $pricingService
    ) {}

    private function getCatalogData(Request $request): array
    {
        $categories = Category::orderBy('sort_order')->get();
        $currency = Currency::where('code', strtoupper($request->get('currency', 'PKR')))->first()
            ?? Currency::where('code', 'PKR')->first();

        $query = Product::with('category')->where('is_active', true);
        if ($request->filled('category') && $request->get('category') !== 'all') {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->get('category')));
        }

        $products = $query->get()->map(function ($product) use ($currency) {
            $product->pricing = $this->pricingService->calculatePrice($product, $currency);
            return $product;
        });

        return [$categories, $products, $currency];
    }

    public function index(Request $request): View|JsonResponse
    {
        [$categories, $products, $currency] = $this->getCatalogData($request);

        if ($request->wantsJson() || $request->ajax() || $request->has('ajax')) {
            return response()->json(['success' => true, 'currency' => $currency, 'products' => $products]);
        }

        return view('welcome', compact('categories', 'products', 'currency'));
    }

    public function catalog(Request $request): View|JsonResponse
    {
        [$categories, $products, $currency] = $this->getCatalogData($request);

        if ($request->wantsJson() || $request->ajax() || $request->has('ajax')) {
            return response()->json(['success' => true, 'currency' => $currency, 'products' => $products]);
        }

        return view('catalog.index', compact('categories', 'products', 'currency'));
    }

    public function showPrice(Request $request, Product $product): JsonResponse
    {
        $currency = Currency::where('code', strtoupper($request->get('currency', 'PKR')))->first();
        $breakdown = $this->pricingService->calculatePrice($product, $currency);

        return response()->json([
            'success' => true,
            'product' => $product->load('category'),
            'pricing' => $breakdown,
        ]);
    }

    public function rates(): View
    {
        $rates = \App\Models\GoldRate::where('is_active', true)->get()->keyBy('karat');
        $usdRate = Currency::where('code', 'USD')->value('exchange_rate_to_pkr') ?: 280.0;
        return view('rates', compact('rates', 'usdRate'));
    }

    public function printRates(): View
    {
        $rates = \App\Models\GoldRate::where('is_active', true)->get()->keyBy('karat');
        $usdRate = Currency::where('code', 'USD')->value('exchange_rate_to_pkr') ?: 278.50;
        return view('rates-print', compact('rates', 'usdRate'));
    }
}
