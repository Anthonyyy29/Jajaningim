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
        Schema::create('table_users', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('username', 20)->unique();
            $table->string('password', 255);
            $table->string('email', 50)->unique();
            $table->timestamp('created_at')->useCurrent();
            $table->enum('role', ['user', 'admin'])->default('user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_users');
    }
};
