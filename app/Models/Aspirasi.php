<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    // Mengizinkan semua kolom untuk diisi (Mass Assignment)
    protected $guarded = [];

    // Menghubungkan Aspirasi dengan Riwayat/Timeline-nya
    public function histories()
    {
        return $this->hasMany(AspirasiHistory::class)->latest();
    }
}