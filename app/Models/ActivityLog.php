<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ActivityLog extends Model
{
    protected $fillable = ['user_id', 'module', 'action', 'description'];

    // Relasi ke tabel Users
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Fungsi Statis agar pencatatan log lebih mudah dan bersih
    public static function record($module, $action, $description)
    {
        if (Auth::check()) {
            self::create([
                'user_id'     => Auth::id(),
                'module'      => $module,
                'action'      => $action,
                'description' => $description,
            ]);
        }
    }
}