<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Currency;
use App\Models\Product;
use App\Services\JewelleryPricingService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function index(Request $request, JewelleryPricingService $pricing): View
    {
        $query = Product::with('category')->where('is_active', true);

        if ($cat = $request->input('category')) {
            if ($cat !== 'all') {
                $query->whereHas('category', fn($q) => $q->where('slug', $cat)->orWhere('id', $cat));
            }
        }

        if ($karat = $request->input('karat')) {
            if ($karat !== 'all') {
                $query->where('karat', strtoupper($karat));
            }
        }

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")->orWhere('stone_description', 'like', "%{$search}%");
            });
        }

        $sort = $request->input('sort', 'latest');
        if ($sort === 'weight_asc') {
            $query->orderBy('gross_weight_grams', 'asc');
        } elseif ($sort === 'weight_desc') {
            $query->orderBy('gross_weight_grams', 'desc');
        } else {
            $query->latest();
        }

        $categories = Category::orderBy('sort_order')->get();
        $currencies = Currency::where('is_active', true)->get();
        $currRates = $currencies->pluck('exchange_rate_to_pkr', 'code');
        $currSymbols = $currencies->pluck('symbol', 'code');

        $products = $query->get()->map(function ($p) use ($pricing) {
            $data = $p->toArray();
            $data['pricing'] = $pricing->calculatePrice($p);
            $data['category_slug'] = $p->category?->slug ?? '';
            $data['category_name'] = $p->category?->name ?? 'Masterpiece';
            return $data;
        });

        if ($sort === 'price_asc') {
            $products = $products->sortBy('pricing.total_price_pkr')->values();
        } elseif ($sort === 'price_desc') {
            $products = $products->sortByDesc('pricing.total_price_pkr')->values();
        }

        return view('shop', [
            'products' => $products,
            'categories' => $categories,
            'currencies' => $currRates,
            'symbols' => $currSymbols,
            'activeCategory' => $request->input('category', 'all'),
            'activeKarat' => $request->input('karat', 'all'),
            'searchQuery' => $request->input('search', ''),
            'activeSort' => $sort,
        ]);
    }
}
