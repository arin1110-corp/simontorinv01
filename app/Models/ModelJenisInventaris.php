<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelJenisInventaris extends Model
{
    use HasFactory;

    protected $table = 'simontorin_jenis_inventaris';
    protected $primaryKey = 'jenis_inventaris_id';
    protected $fillable = ['jenis_inventaris_nama', 'jenis_inventaris_status', 'jenis_inventaris_kode'];

    public function simontorin_inventaris()
    {
        return $this->hasMany(ModelInventaris::class, 'inventaris_jenis', 'jenis_inventaris_id');
    }
}