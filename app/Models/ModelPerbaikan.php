<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelPerbaikan extends Model
{
    use HasFactory;

    protected $table = 'simontorin_perbaikan';
    protected $primaryKey = 'perbaikan_id';
    protected $fillable = [
        'perbaikan_inventaris',
        'perbaikan_tanggal_masuk',
        'perbaikan_tanggal_selesai',
        'perbaikan_keluhan',
        'perbaikan_tindakan',
        'perbaikan_status',
        'perbaikan_keterangan',
    ];
}