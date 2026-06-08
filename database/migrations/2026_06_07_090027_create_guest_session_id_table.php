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
        Schema::create('guest_session_ids', function (Blueprint $table) {
            $table->id();
            $table->string('session_token')->unique();
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
        Schema::dropIfExists('guest_session_ids');
    }
};
