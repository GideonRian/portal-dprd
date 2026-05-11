<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    // Mendefinisikan secara ketat kolom apa saja yang boleh diisi dari Form
    protected $fillable = [
        'foto',
        'nama',
        'tanggal_lahir',
        'telepon',
        'email',
        'jabatan',
        'partai',
        'dapil',
        'komisi',
        'jabatan_komisi',
        'badan',
        'jabatan_badan',
        'riwayat_pendidikan',
        'riwayat_pekerjaan',
        'riwayat_penghargaan',
    ];
}