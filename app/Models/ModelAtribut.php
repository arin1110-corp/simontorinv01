<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelAtribut extends Model
{
    use HasFactory;

    protected $table = 'simontorin_inventaris_detail';
    protected $primaryKey = 'detail_id';
    protected $fillable = [
        'detail_inventaris',
        'detail_nama',
        'detail_isi',
        'detail_foto',
    ];
}