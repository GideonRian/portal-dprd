<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade'); // ditambahkan nullable
        $table->string('module');
        $table->string('action');
        $table->text('description');
        $table->string('status')->default('success'); // kolom baru
        $table->string('ip_address')->nullable();     // kolom baru
        $table->string('user_agent')->nullable();     // kolom baru
        $table->json('old_data')->nullable();         // kolom baru
        $table->json('new_data')->nullable();         // kolom baru
        $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};