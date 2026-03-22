<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelInventaris extends Model
{
    use HasFactory;

    protected $table = 'simontorin_inventaris';
    protected $primaryKey = 'inventaris_id';
    protected $fillable = ['inventaris_kode', 'inventaris_barcode', 'inventaris_nama', 'inventaris_merk', 'inventaris_model', 'inventaris_jenis', 'inventaris_tahun_perolehan', 'inventaris_asalusul', 'inventaris_keterangan', 'inventaris_kondisi', 'inventaris_status', 'inventaris_alasan_dihapus'];

    public function simontorin_jenis_inventaris()
    {
        return $this->belongsTo(ModelJenisInventaris::class, 'inventaris_jenis', 'jenis_inventaris_id');
    }
}