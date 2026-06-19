<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('module')->nullable(); // Bawaan dari kodemu sebelumnya
            $table->string('action'); // Contoh: LOGIN_SUCCESS
            $table->string('description'); // Contoh: Login berhasil dengan 2FA
            $table->enum('status', ['success', 'warning', 'error'])->default('success');
            $table->string('ip_address')->nullable(); // Pelacak IP
            $table->string('user_agent')->nullable(); // Pelacak Browser/Device
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('activity_logs');
    }
};