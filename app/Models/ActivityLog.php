<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ActivityLog extends Model
{
    // Mengizinkan semua kolom diisi massal
    protected $guarded = [];

    // Relasi ke tabel Users
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Fungsi Statis dengan urutan parameter yang AMAN untuk kode lamamu
    // Format: ActivityLog::record('Nama_Module', 'NAMA_AKSI', 'Deskripsi singkat', 'status');
    public static function record($module, $action, $description, $status = 'success', $old_data = null, $new_data = null)
    {
        self::create([
            'user_id'     => \Illuminate\Support\Facades\Auth::check() ? \Illuminate\Support\Facades\Auth::id() : null, 
            'module'      => $module,
            'action'      => strtoupper($action),
            'description' => $description,
            'status'      => strtolower($status),
            'ip_address'  => \Illuminate\Support\Facades\Request::ip(),
            'user_agent'  => \Illuminate\Support\Facades\Request::header('user-agent'),
            // Simpan array sebagai JSON
            'old_data'    => $old_data ? json_encode($old_data) : null,
            'new_data'    => $new_data ? json_encode($new_data) : null,
        ]);
    }
}