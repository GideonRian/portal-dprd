<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class Agenda extends Model
{
    use HasFactory, Auditable;
    // Tambahkan baris ini untuk mengizinkan semua field diisi (mass assignment)
    protected $guarded = [];
}