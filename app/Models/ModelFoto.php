<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelFoto extends Model
{
    use HasFactory;

    protected $table = 'simontorin_foto';
    protected $primaryKey = 'foto_id';
    protected $fillable = [
        'foto_inventaris',
        'foto_path',
    ];
}