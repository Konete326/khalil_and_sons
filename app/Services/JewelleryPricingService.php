<?php

namespace App\Services;

use App\Models\Currency;
use App\Models\GoldRate;
use App\Models\Product;

class JewelleryPricingService
{
    public function calculatePrice(Product $product, Currency|string|null $currency = null): array
    {
        if (is_string($currency)) {
            $currency = Currency::where('code', strtoupper($currency))->first();
        }
        $currency = $currency ?? Currency::where('code', 'PKR')->first();

        $goldRate = GoldRate::where('karat', $product->karat)->active()->first()
            ?? GoldRate::where('karat', '22K')->first();

        $ratePerGram = (float) ($goldRate?->rate_per_gram ?? 0);
        $grossWeight = (float) $product->gross_weight_grams;
        $netGoldWeight = (float) $product->net_gold_weight_grams;
        $stoneWeight = max(0.0, round($grossWeight - $netGoldWeight, 3));

        $gemstoneCost = (float) $product->gemstone_cost;
        $isStudded = ($gemstoneCost > 0 || $stoneWeight > 0);
        $makingRate = $isStudded ? 1500.0 : 1000.0;

        $goldCost = round($netGoldWeight * $ratePerGram, 2);
        $makingCharges = round($grossWeight * $makingRate, 2);
        $totalPkr = round($goldCost + $makingCharges + $gemstoneCost, 2);

        $exchangeRate = (float) ($currency?->exchange_rate_to_pkr ?? 1.0);
        $rate = $exchangeRate > 0 ? $exchangeRate : 1.0;
        $currencyCode = $currency?->code ?? 'PKR';
        $currencySymbol = $currency?->symbol ?? 'Rs.';

        $totalConverted = ($currencyCode === 'PKR')
            ? $totalPkr
            : round($totalPkr / $rate, 2);

        $decimals = ($currencyCode === 'PKR') ? 0 : 2;
        $formattedTotal = $currencySymbol . ' ' . number_format($totalConverted, $decimals);

        return [
            'product_id' => $product->id,
            'title' => $product->title,
            'karat' => $product->karat,
            'rate_per_gram' => $ratePerGram,
            'rate_per_tola' => (float) ($goldRate?->rate_per_tola ?? 0),
            'gross_weight_grams' => $grossWeight,
            'net_gold_weight_grams' => $netGoldWeight,
            'stone_weight_grams' => $stoneWeight,
            'is_studded' => $isStudded,
            'making_rate_per_gram' => $makingRate,
            'gold_cost_pkr' => $goldCost,
            'making_charges_pkr' => $makingCharges,
            'gemstone_cost_pkr' => $gemstoneCost,
            'total_price_pkr' => $totalPkr,
            'currency_code' => $currencyCode,
            'currency_symbol' => $currencySymbol,
            'exchange_rate' => $rate,
            'total_converted' => $totalConverted,
            'formatted_total' => $formattedTotal,
            'formatted_gold_cost' => 'Rs. ' . number_format($goldCost, 0),
            'formatted_making_charges' => 'Rs. ' . number_format($makingCharges, 0),
            'formatted_gemstone_cost' => 'Rs. ' . number_format($gemstoneCost, 0),
            'formatted_total_pkr' => 'Rs. ' . number_format($totalPkr, 0),
            'stone_standard' => 'Stones <= 1.5mm stay within gold weight; stones > 1.5mm are deducted from gold weight and billed under gemstone cost.',
            'gold_lock_policy' => '100% advance payment guarantees spot gold price lock at Murshid Bazaar booking date.',
        ];
    }
}
