<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class Berita extends Model
{
    use HasFactory, Auditable;
    protected $guarded = [];

    // Tambahkan ini agar Laravel otomatis mengelola array gambar
    protected $casts = [
        'gambar' => 'array',
    ];
}