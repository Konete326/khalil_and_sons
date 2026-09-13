<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@khaliljewellers.pk'],
            [
                'name' => 'Khalil Ahmed (Master Proprietor)',
                'password' => Hash::make('SaddarJewel@1991'),
                'email_verified_at' => now(),
            ]
        );
    }
}
