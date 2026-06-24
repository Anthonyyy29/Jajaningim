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
        Schema::create('table_guest_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('session_token', 255)->unique();
            $table->text('email')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('expired_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_guest_sessions');
    }
};
