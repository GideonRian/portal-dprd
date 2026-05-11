<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('anggotas', function (Blueprint $table) {
            // Mengubah kolom menjadi nullable agar boleh dikosongkan
            $table->string('komisi')->nullable()->change();
            $table->string('badan')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('anggotas', function (Blueprint $table) {
            $table->string('komisi')->change();
            $table->string('badan')->change();
        });
    }
};