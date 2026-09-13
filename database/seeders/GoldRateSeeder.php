<?php

namespace Database\Seeders;

use App\Models\GoldRate;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class GoldRateSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $rates = [
            [
                'karat' => '24K',
                'rate_per_gram' => 21262.37,
                'rate_per_tola' => 248000.00,
                'effective_date' => $now,
                'is_active' => true,
            ],
            [
                'karat' => '22K',
                'rate_per_gram' => 19490.47,
                'rate_per_tola' => 227333.00,
                'effective_date' => $now,
                'is_active' => true,
            ],
            [
                'karat' => '21K',
                'rate_per_gram' => 18604.57,
                'rate_per_tola' => 217000.00,
                'effective_date' => $now,
                'is_active' => true,
            ],
            [
                'karat' => '18K',
                'rate_per_gram' => 15946.77,
                'rate_per_tola' => 186000.00,
                'effective_date' => $now,
                'is_active' => true,
            ],
        ];

        foreach ($rates as $rate) {
            GoldRate::updateOrCreate(['karat' => $rate['karat']], $rate);
        }
    }
}
