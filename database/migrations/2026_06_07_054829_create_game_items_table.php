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
        Schema::create('game_items', function (Blueprint $table) {
            $table->id('id_item');
            $table->unsignedBigInteger('game_id');

            $table->foreign('game_id')
                ->references('id_game')
                ->on('games')
                ->onDelete('cascade');

            $table->string('label_item', 30);
            $table->integer('price');

            $table->enum('type', [
                'subscription',
                'non_subscription'
            ])->default('non_subscription');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_items');
    }
};
