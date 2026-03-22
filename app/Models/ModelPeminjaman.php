<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelPeminjaman extends Model
{
    use HasFactory;
    protected $table = 'simontorin_peminjaman';
    protected $primaryKey = 'peminjaman_id';
    protected $fillable = [
        'peminjaman_inventaris',
        'peminjaman_user',
        'peminjaman_tanggal',
        'peminjaman_tanggal_kembali',
        'peminjaman_status',
        'peminjaman_keterangan',
    ];
}