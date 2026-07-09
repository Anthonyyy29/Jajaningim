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
            ['metode_payment' => 'QRIS', 'midtrans_code' => 'other_qris', 'logo' => 'qris.png', 'is_active' => 'true'],
            ['metode_payment' => 'GoPay', 'midtrans_code' => 'gopay', 'logo' => 'gopay.png', 'is_active' => 'true'],
            ['metode_payment' => 'ShopeePay', 'midtrans_code' => 'shopeepay', 'logo' => 'shopeepay.png', 'is_active' => 'true'],
            ['metode_payment' => 'DANA', 'midtrans_code' => 'dana', 'logo' => 'dana.png', 'is_active' => 'true'],
            ['metode_payment' => 'OVO', 'midtrans_code' => 'ovo', 'logo' => 'ovo.png', 'is_active' => 'true'],
        ]);
    }
}
