<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $guarded = [];

    // Tambahkan ini agar Laravel otomatis mengelola array gambar
    protected $casts = [
        'gambar' => 'array',
    ];
}