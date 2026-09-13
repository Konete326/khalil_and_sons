<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Tripo3DService
{
    private string $apiKey;
    private string $baseUrl = 'https://openapi.tripo3d.ai/v3';

    public function __construct()
    {
        $this->apiKey = env('TRIPO3D_API_KEY', '');
    }

    public function createDraftModel(string $prompt, ?string $imagePublicUrl = null): array
    {
        try {
            $payload = [
                'prompt' => $prompt ?: 'luxury 22k gold bridal jewellery',
                'model' => 'v3.1-20260211',
            ];

            $response = Http::withHeaders([
                'Authorization' => "Bearer {$this->apiKey}",
                'Content-Type' => 'application/json',
            ])->withoutVerifying()->timeout(15)->post("{$this->baseUrl}/generation/text-to-model", $payload);

            $data = $response->json();
            if ($response->successful() && isset($data['data']['task_id'])) {
                return [
                    'task_id' => $data['data']['task_id'],
                    'status' => 'queued',
                    'progress' => 0,
                    'is_simulation' => false,
                ];
            }
        } catch (\Throwable $e) {
            Log::warning('Tripo3D create failed: ' . $e->getMessage());
        }

        $simId = 'sim_' . substr(md5(uniqid('', true)), 0, 12);
        Cache::put("tripo_{$simId}", ['created_at' => now()->timestamp, 'step' => 0], 3600);

        return [
            'task_id' => $simId,
            'status' => 'queued',
            'progress' => 15,
            'is_simulation' => true,
        ];
    }

    public function pollTaskStatus(string $taskId): array
    {
        if (str_starts_with($taskId, 'sim_')) {
            $cacheKey = "tripo_{$taskId}";
            $meta = Cache::get($cacheKey, ['created_at' => now()->timestamp, 'step' => 0]);
            $step = ($meta['step'] ?? 0) + 1;
            Cache::put($cacheKey, ['created_at' => $meta['created_at'], 'step' => $step], 3600);

            if ($step >= 3) {
                return [
                    'task_id' => $taskId,
                    'status' => 'success',
                    'progress' => 100,
                    'model_url' => asset('assets/models/bridal-choker.glb'),
                ];
            }

            return [
                'task_id' => $taskId,
                'status' => 'running',
                'progress' => $step === 1 ? 45 : 85,
                'model_url' => null,
            ];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$this->apiKey}",
            ])->withoutVerifying()->timeout(10)->get("{$this->baseUrl}/tasks/{$taskId}");

            if ($response->successful()) {
                $task = $response->json()['data'] ?? [];
                return [
                    'task_id' => $taskId,
                    'status' => $task['status'] ?? 'unknown',
                    'progress' => $task['progress'] ?? 0,
                    'model_url' => $task['output']['model_url'] ?? null,
                ];
            }
        } catch (\Throwable $e) {
            Log::warning('Tripo3D poll error: ' . $e->getMessage());
        }

        return [
            'task_id' => $taskId,
            'status' => 'failed',
            'progress' => 0,
            'model_url' => null,
        ];
    }
}
