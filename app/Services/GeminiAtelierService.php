<?php

namespace App\Services;

use App\Models\GoldRate;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiAtelierService
{
    private string $apiKey;
    private array $models = ['gemini-3.6-flash', 'gemini-2.5-flash', 'gemini-flash-latest'];

    public function __construct()
    {
        $this->apiKey = env('GEMINI_API_KEY', '');
    }

    public function chat(string $message, array $history = [], ?string $imagePath = null): array
    {
        $systemPrompt = $this->buildSystemPrompt();
        $contents = [];

        foreach ($history as $item) {
            $role = ($item['role'] ?? 'user') === 'assistant' ? 'model' : 'user';
            $contents[] = [
                'role' => $role,
                'parts' => [['text' => $item['content'] ?? '']],
            ];
        }

        $userParts = [['text' => $message]];

        if ($imagePath && file_exists($imagePath)) {
            $mime = mime_content_type($imagePath) ?: 'image/jpeg';
            $base64 = base64_encode(file_get_contents($imagePath));
            $userParts[] = [
                'inline_data' => [
                    'mime_type' => $mime,
                    'data' => $base64,
                ],
            ];
        }

        $contents[] = [
            'role' => 'user',
            'parts' => $userParts,
        ];

        foreach ($this->models as $model) {
            $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$this->apiKey}";
            try {
                $response = Http::withHeaders(['Content-Type' => 'application/json'])
                    ->withoutVerifying()
                    ->timeout(25)
                    ->post($url, [
                        'system_instruction' => ['parts' => [['text' => $systemPrompt]]],
                        'contents' => $contents,
                        'generationConfig' => ['temperature' => 0.7, 'maxOutputTokens' => 800],
                    ]);

                if ($response->successful()) {
                    $json = $response->json();
                    $reply = $json['candidates'][0]['content']['parts'][0]['text'] ?? '';
                    if (!empty($reply)) {
                        return $this->parseResponse($reply);
                    }
                }
            } catch (\Throwable $e) {
                Log::warning('Gemini error: ' . $e->getMessage());
            }
        }

        return [
            'reply' => 'Assalamu Alaikum. Welcome to Khalil & Sons Jewellers atelier in Murshid Bazaar, Saddar. Our master artisans are pleased to assist with your bespoke 22K bridal commission. Could you specify your desired piece, target weight in grams, and gemstone preferences?',
            'estimate' => null,
        ];
    }

    private function buildSystemPrompt(): string
    {
        $rate22k = GoldRate::where('karat', '22K')->first()?->rate_per_gram ?? 35365;
        $rate24k = GoldRate::where('karat', '24K')->first()?->rate_per_gram ?? 38580;

        return "You are the master goldsmith concierge at Khalil & Sons Jewellers, established 1991 in Murshid Bazaar, Saddar, Karachi. "
            . "Guide patrons to specify: 1) Karat (18K, 21K, 22K, 24K), 2) Target gold weight in grams, 3) Gemstone type or own gold provided. "
            . "Enforce Saddar Sarafa rules: Current 22K spot rate is Rs. {$rate22k}/g (24K is Rs. {$rate24k}/g). "
            . "Plain making charges: Rs. 1,000/g. Studded making charges: Rs. 1,500/g. "
            . "Stone deduction: Stones <= 1.5mm stay within gold weight; stones > 1.5mm are deducted and billed under gemstone cost. "
            . "100% advance gold lock is required to fix spot rate. "
            . "If sufficient details exist to estimate, append on a single line: [ESTIMATE:{\"karat\":\"22K\",\"weight_grams\":20,\"gold_rate\":{$rate22k},\"making_charges\":30000,\"gemstone_cost\":0,\"total_pkr\":737300}]. "
            . "Be courteous, regal, and culturally attuned to Pakistani bridal heirlooms.";
    }

    private function parseResponse(string $raw): array
    {
        $estimate = null;
        $cleanReply = $raw;

        if (preg_match('/\[ESTIMATE:(.*?)\]/s', $raw, $matches)) {
            $parsed = json_decode(trim($matches[1]), true);
            if (is_array($parsed)) {
                $estimate = $parsed;
            }
            $cleanReply = trim(str_replace($matches[0], '', $raw));
        }

        return ['reply' => $cleanReply, 'estimate' => $estimate];
    }
}
