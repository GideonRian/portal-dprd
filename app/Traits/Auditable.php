<?php

namespace App\Traits;

use App\Models\ActivityLog;

/**
 * @method static void created(\Closure $callback)
 * @method static void updated(\Closure $callback)
 * @method static void deleted(\Closure $callback)
 */
trait Auditable
{
    /**
     * Menyadap event Eloquent (Create, Update, Delete) secara otomatis
     */
    public static function bootAuditable()
    {
        static::created(function ($model) {
            self::recordAudit('CREATE', $model);
        });

        static::updated(function ($model) {
            self::recordAudit('UPDATE', $model);
        });

        static::deleted(function ($model) {
            self::recordAudit('DELETE', $model);
        });
    }

    protected static function recordAudit($action, $model)
    {
        $oldData = null;
        $newData = null;

        // PERBAIKAN LOGIKA PENGAMBILAN DATA
        if ($action === 'CREATE') {
            $newData = $model->getAttributes(); // Ambil seluruh data yang baru dibuat
        } elseif ($action === 'UPDATE') {
            $oldData = $model->getOriginal();   // Ambil wujud asli sebelum diubah
            $newData = $model->getChanges();    // Ambil HANYA kolom yang diubah
        } elseif ($action === 'DELETE') {
            $oldData = $model->getAttributes(); // Ambil seluruh data sebelum dilenyapkan
        }

        // Pencegahan log sampah: Jika diklik "Simpan" tapi tidak ada teks yang diubah, batalkan!
        if ($action === 'UPDATE' && empty($newData)) {
            return;
        }

        // Deteksi otomatis nama modul (Misal: dari model Agenda akan menjadi "Agenda")
        $moduleName = class_basename($model); 

        // Kirim ke fungsi statis record() di ActivityLog
        ActivityLog::record(
            $moduleName,                                                                 
            $action,                                                                     
            "Melakukan aksi {$action} pada data {$moduleName} (ID: {$model->id})",       
            'success',                                                                   
            $oldData,                                                                    
            $newData                                                                     
        );
    }
}