<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelUser extends Model
{
    use HasFactory;

    protected $table = 'simontorin_user_role';
    protected $primaryKey = 'user_role_id';
    protected $fillable = [
        'user_role_user',
        'user_role_nama',
    ];
}