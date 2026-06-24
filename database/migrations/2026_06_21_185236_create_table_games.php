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
        Schema::create('table_games', function (Blueprint $table) {
            $table->id('id_game');
            $table->string('nama_game', 255);
            $table->string('gambar_game', 255);
            $table->text('deskripsi_game')->nullable();
            $table->enum('is_active', ['true', 'false'])->default('true');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_games');
    }
};
