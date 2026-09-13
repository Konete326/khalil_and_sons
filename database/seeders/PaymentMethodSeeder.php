<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    public function run(): void
    {
        $methods = [
            [
                'type' => 'raast',
                'title' => 'Raast Instant Settlement (P2M)',
                'account_name' => 'Khalil and Sons Jewellers',
                'account_number' => '03008241991',
                'iban' => 'PK54MEZN0001020304050607',
                'swift_code' => null,
                'bank_name' => 'Meezan Bank Limited',
                'instructions' => 'Use State Bank Raast for zero-fee instant settlement. Reference your Order Tracking ID.',
                'is_active' => true,
            ],
            [
                'type' => 'bank_transfer',
                'title' => 'Meezan Bank Corporate Account',
                'account_name' => 'Khalil & Sons Jewellers PVT LTD',
                'account_number' => '01020304050607',
                'iban' => 'PK54MEZN0001020304050607',
                'swift_code' => null,
                'bank_name' => 'Meezan Bank Limited (Saddar Flagship Branch)',
                'instructions' => 'Transfer to corporate account. Upload digital deposit slip or internet banking receipt.',
                'is_active' => true,
            ],
            [
                'type' => 'swift',
                'title' => 'Overseas Telegraphic Transfer (SWIFT)',
                'account_name' => 'Khalil & Sons Jewellers Private Limited',
                'account_number' => '01020304050607',
                'iban' => 'PK54MEZN0001020304050607',
                'swift_code' => 'MEZNPKKA',
                'bank_name' => 'Meezan Bank Limited (Karachi Main)',
                'instructions' => 'Direct overseas wire transfer. Ensure beneficiary name and IBAN match exactly.',
                'is_active' => true,
            ],
            [
                'type' => 'wise',
                'title' => 'Wise International Remittance',
                'account_name' => 'Khalil & Sons Atelier',
                'account_number' => 'WISE-KS-91024',
                'iban' => 'BE68539007547034',
                'swift_code' => null,
                'bank_name' => 'Wise Europe SA',
                'instructions' => 'For overseas patrons in UK, US, and GCC. Transfer via Wise app with real-time rate.',
                'is_active' => true,
            ],
        ];

        foreach ($methods as $method) {
            PaymentMethod::updateOrCreate(['title' => $method['title']], $method);
        }
    }
}
