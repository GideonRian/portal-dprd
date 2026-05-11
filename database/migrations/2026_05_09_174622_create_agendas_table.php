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
    Schema::create('agendas', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->date('tanggal');
        $table->string('waktu'); // Contoh: 09:00 - 12:00 WIB
        $table->string('status'); // Akan Datang, Selesai
        $table->string('lokasi');
        $table->string('kategori'); // Rapat Paripurna, Kunjungan Kerja, dll
        $table->string('peserta');
        $table->text('deskripsi');
        $table->string('gambar')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};
