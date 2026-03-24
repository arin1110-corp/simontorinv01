<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ModelUser extends Authenticatable
{
    use HasFactory;

    protected $table = 'simontorin_user_role';
    protected $primaryKey = 'user_role_id';

    public $timestamps = true;

    protected $fillable = [
        'user_role_user',
        'user_role_nama'
    ];

    // ❌ HAPUS TOTAL remember token override
    // Laravel akan handle sendiri

    protected $hidden = [
        'remember_token',
    ];

    // helper role (optional)
    public function getRoleAttribute()
    {
        return $this->user_role_nama;
    }
}