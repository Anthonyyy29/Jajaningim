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
        Schema::create('transaction', function (Blueprint $table) {
            $table->id('id_transaction');

            $table->unsignedBigInteger('id_item');
            $table->unsignedBigInteger('id_payment');

            $table->unsignedBigInteger('id_akun')->nullable();
            $table->unsignedBigInteger('guest_session_id')->nullable();

            $table->string('game_user_id')->nullable();
            $table->string('game_zone_id')->nullable();

            $table->enum('status_transaction', [
                'pending',
                'success',
                'failed'
            ])->default('pending');

            $table->enum('status_payment', [
                'unpaid',
                'paid'
            ])->default('unpaid');

            $table->dateTime('date_transaction')
                ->useCurrent();

            $table->foreign('id_item')
                ->references('id_item')
                ->on('game_items')
                ->onDelete('cascade');

            $table->foreign('id_akun')
                ->references('id_akun')
                ->on('akun')
                ->nullOnDelete();

            $table->foreign('guest_session_id')
                ->references('id')
                ->on('guest_session_id')
                ->nullOnDelete();

            $table->foreign('id_payment')
                ->references('id_payment')
                ->on('payment_method')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction');
    }
};
