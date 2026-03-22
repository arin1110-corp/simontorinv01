<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelDetailKir extends Model
{
    use HasFactory;

    protected $table = 'simontorin_kir_detail';
    protected $primaryKey = 'kir_detail_id';

    protected $fillable = [
        'kir_detail_kir',
        'kir_detail_inventaris',
        'kir_detail_jumlah',
    ];
}