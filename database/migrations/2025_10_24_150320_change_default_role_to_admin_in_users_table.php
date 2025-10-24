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
        // PERTEMUAN 7
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['root', 'admin', 'user'])->default('admin')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // PERTEMUAN 7
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['root', 'admin', 'user'])->default('user')->change();
        });
    }
};
