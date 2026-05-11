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
    Schema::table('anggotas', function (Blueprint $table) {
        $table->date('tanggal_lahir')->nullable()->after('nama');
        $table->text('riwayat_pendidikan')->nullable();
        $table->text('riwayat_pekerjaan')->nullable();
        $table->text('riwayat_penghargaan')->nullable();
        $table->string('jabatan_komisi')->nullable()->comment('Contoh: Ketua, Wakil, Anggota');
        $table->string('jabatan_badan')->nullable()->comment('Contoh: Anggota, Sekretaris');
    });
}

public function down(): void
{
    Schema::table('anggotas', function (Blueprint $table) {
        $table->dropColumn([
            'tanggal_lahir', 'riwayat_pendidikan', 'riwayat_pekerjaan', 
            'riwayat_penghargaan', 'jabatan_komisi', 'jabatan_badan'
        ]);
    });
}
};
