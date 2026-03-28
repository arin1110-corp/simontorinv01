<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelKodeAtas extends Model
{
    use HasFactory;
    protected $table = 'simontorin_kodeatas';
    protected $primaryKey = 'kodeatas_id';
    protected $fillable=['kodeatas_isi'];
}