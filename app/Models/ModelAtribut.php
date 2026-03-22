<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelAtribut extends Model
{
    use HasFactory;

    protected $table = 'simontorin_inventaris_detail';
    protected $primaryKey = 'inventaris_detail_id';
    protected $fillable = [
        'inventaris_detail_inventaris',
        'detail_nama',
        'detail_isi',
    ];
}