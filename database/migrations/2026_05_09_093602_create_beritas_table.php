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
    Schema::create('beritas', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->string('slug')->unique(); // Untuk URL SEO-friendly
        $table->date('tanggal');
        $table->string('kategori');
        $table->json('gambar')->nullable();
        $table->text('ringkasan');
        $table->longText('konten');
        $table->boolean('is_featured')->default(false); // Penanda berita unggulan
        $table->timestamps();
    });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
