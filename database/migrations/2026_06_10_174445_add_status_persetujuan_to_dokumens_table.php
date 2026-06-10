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
    Schema::table('dokumens', function (Blueprint $table) {
        // Nilai bawaan adalah 'Pending'. Pilihan lainnya: 'Approved', 'Rejected'
        $table->string('status_persetujuan')->default('Pending')->after('deskripsi');
    });
    }

    public function down(): void
    {
        Schema::table('dokumens', function (Blueprint $table) {
            $table->dropColumn('status_persetujuan');
        });
    }
};
