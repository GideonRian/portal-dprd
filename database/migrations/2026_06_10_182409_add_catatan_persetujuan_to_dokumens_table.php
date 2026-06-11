<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dokumens', function (Blueprint $table) {
            // Kolom teks yang boleh kosong (nullable)
            $table->text('catatan_persetujuan')->nullable()->after('status_persetujuan');
        });
    }

    public function down(): void
    {
        Schema::table('dokumens', function (Blueprint $table) {
            $table->dropColumn('catatan_persetujuan');
        });
    }
};