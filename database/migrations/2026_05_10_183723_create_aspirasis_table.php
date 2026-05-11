<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aspirasis', function (Blueprint $table) {
            $table->id();
            $table->string('tiket_id')->unique();
            $table->string('nama');
            $table->string('email');
            $table->string('telepon');
            $table->text('alamat')->nullable();
            $table->string('kategori');
            $table->string('judul');
            $table->text('pesan');
            $table->string('status')->default('Menunggu');
            $table->string('pic')->nullable(); 
            $table->text('keterangan')->nullable(); 
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aspirasis');
    }
};