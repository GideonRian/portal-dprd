<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AspirasiHistory extends Model
{
    // Mengizinkan semua kolom untuk diisi
    protected $guarded = [];

    // Relasi balik ke tabel utama (Aspirasi)
    public function aspirasi()
    {
        return $this->belongsTo(Aspirasi::class);
    }
}