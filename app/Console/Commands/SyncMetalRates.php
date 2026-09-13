<?php

namespace App\Console\Commands;

use App\Services\MetalRateSyncService;
use Illuminate\Console\Command;

class SyncMetalRates extends Command
{
    protected $signature = 'rates:sync';
    protected $description = 'Synchronize live Karachi Sarafa gold and silver rates via GoldAPI';

    public function handle(MetalRateSyncService $service): int
    {
        $this->info('Connecting to GoldAPI for live Karachi metal valuations...');
        $rates = $service->sync();

        if (empty($rates)) {
            $this->error('Failed to sync metal rates and no fallback available.');
            return Command::FAILURE;
        }

        $rows = [];
        foreach ($rates as $karat => $record) {
            $rows[] = [
                'Metal / Karat' => $karat === 'SILVER' ? 'Fine Silver (Chandi)' : "{$karat} Gold",
                'Rate / Gram' => 'Rs. ' . number_format($record->rate_per_gram, 2),
                'Rate / Tola' => 'Rs. ' . number_format($record->rate_per_tola, 2),
                'Effective Date' => $record->effective_date?->format('Y-m-d H:i:s') ?? 'N/A',
            ];
        }

        $this->table(['Metal / Karat', 'Rate / Gram', 'Rate / Tola', 'Effective Date'], $rows);
        $this->info('Karachi Sarafa rates successfully updated in gold_rates table.');

        return Command::SUCCESS;
    }
}
