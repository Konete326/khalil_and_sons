<?php

namespace App\Services;

use App\Models\GoldRate;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiAtelierService
{
    private string $apiKey;
    private array $models = ['gemini-2.5-flash', 'gemini-1.5-flash'];

    public function __construct()
    {
        $raw = env('GEMINI_API_KEY', '');
        $this->apiKey = str_starts_with($raw, 'b64:') ? (base64_decode(substr($raw, 4)) ?: '') : $raw;
    }

    public function chat(string $message, array $history = [], ?string $imagePath = null): array
    {
        $rate22k = GoldRate::where('karat', '22K')->first()?->rate_per_gram ?? 35365;
        $contents = [];
        foreach ($history as $item) {
            $role = ($item['role'] ?? 'user') === 'assistant' ? 'model' : 'user';
            $contents[] = ['role' => $role, 'parts' => [['text' => $item['content'] ?? '']]];
        }
        $userParts = [['text' => $message]];
        if ($imagePath && file_exists($imagePath)) {
            $mime = mime_content_type($imagePath) ?: 'image/jpeg';
            $base64 = base64_encode(file_get_contents($imagePath));
            $userParts[] = ['inline_data' => ['mime_type' => $mime, 'data' => $base64]];
        }
        $contents[] = ['role' => 'user', 'parts' => $userParts];

        if (!empty($this->apiKey)) {
            $systemPrompt = $this->buildSystemPrompt($rate22k);
            foreach ($this->models as $model) {
                $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$this->apiKey}";
                try {
                    $response = Http::withHeaders(['Content-Type' => 'application/json'])
                        ->withoutVerifying()->timeout(20)->post($url, [
                            'system_instruction' => ['parts' => [['text' => $systemPrompt]]],
                            'contents' => $contents,
                            'generationConfig' => ['temperature' => 0.6, 'maxOutputTokens' => 800],
                        ]);
                    if ($response->successful()) {
                        $reply = $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? '';
                        if (!empty($reply)) return $this->parseResponse($reply);
                    }
                } catch (\Throwable $e) {
                    Log::warning('Gemini error: ' . $e->getMessage());
                }
            }
        }
        return $this->heuristicFallback($message, $imagePath !== null, $rate22k);
    }

    private function buildSystemPrompt(float $rate22k): string
    {
        $rate24k = GoldRate::where('karat', '24K')->first()?->rate_per_gram ?? 38580;
        return "You are the Master Goldsmith at Khalil & Son's Jewellers, Murshid Bazaar, Saddar, Karachi (Est. 1991). "
            . "When evaluating commissions or patron images: 1) Analyze design aesthetics, detailing if it is plain solid gold or stone-studded (polki, rubies, pearls, diamonds). "
            . "2) Enforce Saddar Sarafa rules: 22K spot is Rs. {$rate22k}/g, 24K is Rs. {$rate24k}/g. Plain making: Rs. 1,000/g. Studded making: Rs. 1,500/g. "
            . "3) Stone rule: 1.5mm stones stay in gross gold weight; stones > 1.5mm deducted from net gold and charged as gemstone cost. "
            . "4) 100% advance gold lock is required to fix the bullion rate. "
            . "Always conclude with a single JSON line: [ESTIMATE:{\"karat\":\"22K\",\"weight_grams\":30,\"gold_rate\":{$rate22k},\"making_charges\":45000,\"gemstone_cost\":35000,\"advance_lock\":1060950,\"total_pkr\":1140950}]. "
            . "Tone: Courteous, regal, master artisan of Karachi heritage.";
    }

    private function heuristicFallback(string $msg, bool $hasImage, float $r22k): array
    {
        $lower = strtolower($msg);
        $isStudded = $hasImage || str_contains($lower, 'choker') || str_contains($lower, 'polki') || str_contains($lower, 'stone') || str_contains($lower, 'ruby') || str_contains($lower, 'jhumka');
        $karat = str_contains($lower, '21k') ? '21K' : (str_contains($lower, '18k') ? '18K' : '22K');
        $rate = $karat === '21K' ? round($r22k * (21/22)) : ($karat === '18K' ? round($r22k * (18/22)) : $r22k);
        preg_match('/(\d+(\.\d+)?)\s*(g|gram)/i', $msg, $m);
        $w = !empty($m[1]) ? (float)$m[1] : ($hasImage ? 32.0 : (str_contains($lower, 'kada') || str_contains($lower, 'bangle') ? 40.0 : (str_contains($lower, 'ring') ? 16.0 : 28.0)));
        $makingRate = $isStudded ? 1500 : 1000;
        $making = round($w * $makingRate);
        $gems = $isStudded ? ($hasImage ? 65000 : 35000) : 0;
        $goldCost = round($w * $rate);
        $total = $goldCost + $making + $gems;
        $style = $isStudded ? 'intricate Jadau stone-studded karigari with Mughal motifs' : 'pure high-luster solid gold hand-carved filigree';
        $reply = "Assalam-o-Alaikum. Our Saddar workshop has analyzed your reference (" . ($hasImage ? "image design sketch" : "inquiry") . "). "
            . "We have calibrated this for {$w}g in {$karat} Solid Gold featuring {$style}. "
            . "Per Karachi Sarafa standards, making is calculated at Rs. " . number_format($makingRate) . "/g, with 100% advance gold lock required to secure today's spot rate. "
            . "Would you like us to customize the gemstone accents or finalize the casting token?";
        return [
            'reply' => $reply,
            'estimate' => [
                'karat' => $karat, 'weight_grams' => $w, 'gold_rate' => $rate, 'making_charges' => $making,
                'gemstone_cost' => $gems, 'advance_lock' => $goldCost, 'total_pkr' => $total, 'is_studded' => $isStudded
            ]
        ];
    }

    private function parseResponse(string $raw): array
    {
        $estimate = null;
        $cleanReply = $raw;
        if (preg_match('/\[ESTIMATE:(.*?)\]/s', $raw, $matches)) {
            $parsed = json_decode(trim($matches[1]), true);
            if (is_array($parsed)) $estimate = $parsed;
            $cleanReply = trim(str_replace($matches[0], '', $raw));
        }
        return ['reply' => $cleanReply, 'estimate' => $estimate];
    }
}
