<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('payment_methods')->insert([
            ['name' => 'QRIS',      'logo' => 'qris.png',      'is_active' => 'true'],
            ['name' => 'GoPay',     'logo' => 'gopay.png',     'is_active' => 'true'],
            ['name' => 'ShopeePay', 'logo' => 'shopeepay.png', 'is_active' => 'true'],
            ['name' => 'DANA',      'logo' => 'dana.png',      'is_active' => 'true'],
            ['name' => 'OVO',       'logo' => 'ovo.png',       'is_active' => 'true'],
        ]);
    }
}
