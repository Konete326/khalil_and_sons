<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            GoldRateSeeder::class,
            PaymentMethodSeeder::class,
            CurrencySeeder::class,
            ProductSeeder::class,
            UserSeeder::class,
            AdminUserSeeder::class,
        ]);
    }
}
