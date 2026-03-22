<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelLokasiRuangan extends Model
{
    use HasFactory;
    protected $table = 'simontorin_lokasi';
    protected $primaryKey = 'lokasi_id';
    protected $fillable = [
        'lokasi_nama',
        'lokasi_keterangan',
    ];
}