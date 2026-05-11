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
    Schema::table('agendas', function (Blueprint $table) {
        // Kita gunakan text agar bisa menyimpan banyak baris
        $table->text('susunan_acara')->nullable()->after('deskripsi');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agendas', function (Blueprint $table) {
            //
        });
    }
};
