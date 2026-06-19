<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable; // <-- 1. TAMBAHKAN IMPORT INI

class Aspirasi extends Model
{
    use Auditable; // <-- 2. PANGGIL TRAIT DI SINI

    // Mengizinkan semua kolom untuk diisi (Mass Assignment)
    protected $guarded = [];

    // Menghubungkan Aspirasi dengan Riwayat/Timeline-nya
    public function histories()
    {
        return $this->hasMany(AspirasiHistory::class)->latest();
    }
}