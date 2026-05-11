<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aspirasi_histories', function (Blueprint $table) {
            $table->id();
            // Menghubungkan riwayat ini dengan tabel aspirasis utama
            $table->foreignId('aspirasi_id')->constrained('aspirasis')->cascadeOnDelete();
            $table->string('status');
            $table->text('catatan')->nullable();
            $table->string('user_name')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aspirasi_histories');
    }
};