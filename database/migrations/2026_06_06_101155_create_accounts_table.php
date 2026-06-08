<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id('id_account');
            $table->string('username_account', 20)->unique();
            $table->string('password');
            $table->string('email', 50)->unique();
            $table->enum('role', ['user', 'admin'])->default('user');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
