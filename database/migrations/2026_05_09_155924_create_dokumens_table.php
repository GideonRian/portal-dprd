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
    Schema::create('dokumens', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->string('kategori');
        $table->string('tahun');
        $table->string('tipe_file')->nullable(); // Menyimpan tipe file (PDF, DOCX, dll)
        $table->string('nama_file')->nullable(); // Nama file kustom
        $table->text('deskripsi');
        $table->string('file_path'); // Lokasi file di storage
        $table->string('ukuran_file')->nullable(); // Menyimpan ukuran file (contoh: 2.4 MB)
        $table->timestamps();
    });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumens');
    }
};
