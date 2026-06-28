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
        Schema::table('table_game_items', function (Blueprint $table) {
            $table->renameColumn('id_games', 'id_game');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse the column rename
        Schema::table('table_game_items', function (Blueprint $table) {
            $table->renameColumn('id_game', 'id_games');
        });
    }
};
