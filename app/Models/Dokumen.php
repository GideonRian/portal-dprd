<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class Dokumen extends Model
{
    use HasFactory, Auditable;
    // Mengizinkan semua kolom diisi secara massal
    protected $guarded = [];

    // Konstanta Status Persetujuan (Menghindari Typo / Magic Strings)
    const STATUS_PENDING = 'Pending';
    const STATUS_APPROVED = 'Approved';
    const STATUS_REJECTED = 'Rejected';

    /**
     * Memeriksa apakah dokumen berstatus Menunggu Persetujuan (Pending).
     */
    public function isPending(): bool
    {
        return $this->status_persetujuan === self::STATUS_PENDING;
    }

    /**
     * Memeriksa apakah dokumen sudah Disetujui (Approved).
     */
    public function isApproved(): bool
    {
        return $this->status_persetujuan === self::STATUS_APPROVED;
    }

    /**
     * Memeriksa apakah dokumen Ditolak / Revisi (Rejected).
     */
    public function isRejected(): bool
    {
        return $this->status_persetujuan === self::STATUS_REJECTED;
    }
}