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
        Schema::create('table_transactions', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->foreignId('id_item')->constrained('table_game_items', 'id_item')->onDelete('cascade');
            $table->foreignId('id_user')->nullable()->constrained('table_users', 'id_user')->onDelete('set null');
            $table->foreignId('guest_session_id')->nullable()->constrained('table_guest_sessions', 'id')->onDelete('set null');
            $table->foreignId('id_payment')->constrained('table_payment_method', 'id_payment')->onDelete('cascade');
            $table->string('game_user_id', 255)->nullable();
            $table->string('game_zone_id', 255)->nullable();
            $table->enum('status_transaksi', ['pending', 'success', 'failed'])->default('pending');
            $table->enum('status_payment', ['unpaid', 'paid'])->default('unpaid');
            $table->dateTime('date_transaksi')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_transactions');
    }
};
