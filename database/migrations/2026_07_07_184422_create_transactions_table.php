<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('order_id', 50)->unique();
            $table->foreignId('game_id')->constrained('games');
            $table->foreignId('game_detail_id')->constrained('game_detail');
            $table->foreignId('payment_method_id')->constrained('table_payment_method');
            $table->json('form_data')->nullable();
            $table->string('email')->nullable();
            $table->unsignedInteger('amount');
            $table->enum('status', ['pending', 'paid', 'failed', 'expired'])->default('pending');
            $table->string('midtrans_snap_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
