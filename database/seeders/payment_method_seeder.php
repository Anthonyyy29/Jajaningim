<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class payment_method_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('table_payment_method')->insert([
            ['metode_payment' => 'QRIS', 'logo' => 'qris.png', 'is_active' => 'true'],
            ['metode_payment' => 'GoPay', 'logo' => 'gopay.png', 'is_active' => 'true'],
            ['metode_payment' => 'ShopeePay', 'logo' => 'shopeepay.png', 'is_active' => 'true'],
            ['metode_payment' => 'DANA', 'logo' => 'dana.png', 'is_active' => 'true'],
            ['metode_payment' => 'OVO', 'logo' => 'ovo.png', 'is_active' => 'true'],
        ]);
    }
}
