<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Store Administrator',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
                'phone' => '03008241991',
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin@khaliljewellers.pk'],
            [
                'name' => 'Khalil Ahmed (Master Proprietor)',
                'password' => Hash::make('SaddarJewel@1991'),
                'is_admin' => true,
                'phone' => '03008241991',
                'email_verified_at' => now(),
            ]
        );
    }
}
