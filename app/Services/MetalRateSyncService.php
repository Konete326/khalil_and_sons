<?php

namespace App\Services;

use App\Models\GoldRate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MetalRateSyncService
{
    private const TOLA_GRAMS = 11.6638;

    public function sync(): array
    {
        $apiKey = env('GOLD_API_KEY');
        $now = Carbon::now();
        $synced = [];

        try {
            $goldRes = Http::withHeaders([
                'x-access-token' => $apiKey,
                'Content-Type' => 'application/json',
            ])->withoutVerifying()->timeout(10)->get('https://www.goldapi.io/api/XAU/PKR');

            if ($goldRes->successful()) {
                $data = $goldRes->json();
                $rates = [
                    '24K' => (float) ($data['price_gram_24k'] ?? 0),
                    '22K' => (float) ($data['price_gram_22k'] ?? 0),
                    '21K' => (float) ($data['price_gram_21k'] ?? 0),
                    '18K' => (float) ($data['price_gram_18k'] ?? 0),
                ];

                foreach ($rates as $karat => $gramRate) {
                    if ($gramRate > 0) {
                        $tolaRate = round($gramRate * self::TOLA_GRAMS, 2);
                        $record = GoldRate::updateOrCreate(
                            ['karat' => $karat],
                            [
                                'rate_per_gram' => round($gramRate, 2),
                                'rate_per_tola' => $tolaRate,
                                'effective_date' => $now,
                                'is_active' => true,
                            ]
                        );
                        $synced[$karat] = $record;
                    }
                }
            }

            $silverRes = Http::withHeaders([
                'x-access-token' => $apiKey,
                'Content-Type' => 'application/json',
            ])->withoutVerifying()->timeout(10)->get('https://www.goldapi.io/api/XAG/PKR');

            if ($silverRes->successful()) {
                $sData = $silverRes->json();
                $sGram = (float) ($sData['price_gram_24k'] ?? 0);
                if ($sGram > 0) {
                    $sTola = round($sGram * self::TOLA_GRAMS, 2);
                    $sRecord = GoldRate::updateOrCreate(
                        ['karat' => 'SILVER'],
                        [
                            'rate_per_gram' => round($sGram, 2),
                            'rate_per_tola' => $sTola,
                            'effective_date' => $now,
                            'is_active' => true,
                        ]
                    );
                    $synced['SILVER'] = $sRecord;
                }
            }
        } catch (\Throwable $e) {
            Log::warning('MetalRateSync error: ' . $e->getMessage());
        }

        if (empty($synced)) {
            return GoldRate::where('is_active', true)->get()->keyBy('karat')->all();
        }

        return $synced;
    }

    public function syncIfStale(): bool
    {
        $latest = GoldRate::where('is_active', true)->latest('effective_date')->first();
        if (!$latest || $latest->effective_date->diffInHours(now()) >= 24) {
            $this->sync();
            return true;
        }
        return false;
    }
}
