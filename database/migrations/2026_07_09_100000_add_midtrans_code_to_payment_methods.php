<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('table_payment_method', function (Blueprint $table) {
            $table->string('midtrans_code', 30)->nullable()->after('metode_payment');
        });

        // Backfill kode Snap enabled_payments untuk metode yang sudah ada di seeder,
        // supaya baris lama (mis. di server yang sudah ter-migrate) langsung terisi
        // tanpa perlu re-seed dari nol.
        $map = [
            'QRIS' => 'other_qris',
            'GoPay' => 'gopay',
            'ShopeePay' => 'shopeepay',
            'DANA' => 'dana',
            'OVO' => 'ovo',
        ];

        foreach ($map as $name => $code) {
            DB::table('table_payment_method')
                ->where('metode_payment', $name)
                ->whereNull('midtrans_code')
                ->update(['midtrans_code' => $code]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('table_payment_method', function (Blueprint $table) {
            $table->dropColumn('midtrans_code');
        });
    }
};
