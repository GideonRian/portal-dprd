<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visit_logs', function (Blueprint $table) {
            $table->id();
            $table->string('session_id'); // Untuk mengelompokkan aktivitas 1 pengunjung
            $table->string('ip_address'); // Untuk mendeteksi keunikan visitor
            $table->string('path');       // Halaman yang dibuka (misal: 'berita', 'kontak')
            $table->timestamps();         // Merekam waktu masuk halaman
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visit_logs');
    }
};