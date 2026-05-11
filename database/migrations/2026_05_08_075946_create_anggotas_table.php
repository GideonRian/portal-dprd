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
    Schema::create('anggotas', function (Blueprint $table) {
        $table->id();
        $table->string('foto')->nullable();
        $table->string('nama');
        $table->string('jabatan');
        $table->string('partai');
        $table->string('komisi');
        $table->string('badan')->nullable();
        $table->string('dapil');
        $table->string('telepon')->nullable();
        $table->string('email')->nullable();
        $table->timestamps();
    });
    }
/**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};
