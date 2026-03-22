<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelKir extends Model
{
    use HasFactory;

    protected $table = 'simontorin_kir';
    protected $primaryKey = 'kir_id';

    protected $fillable = [
        'kir_nama',
        'kir_tanggal',
        'kir_keterangan',
    ];
}