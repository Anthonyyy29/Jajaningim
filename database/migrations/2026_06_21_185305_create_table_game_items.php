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
        Schema::create('table_game_items', function (Blueprint $table) {
            $table->id('id_item');
            $table->foreignId('id_games')->constrained('table_games', 'id_game')->onDelete('cascade');
            $table->string('label_item', 30);
            $table->integer('price');
            $table->enum('type', ['subscription', 'non_subscription'])->default('non_subscription');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_game_items');
    }
};
