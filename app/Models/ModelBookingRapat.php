<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelBookingRapat extends Model
{
    use HasFactory;
    protected $table = 'simontorin_booking_rapat';
    protected $primaryKey = 'booking_id';
    protected $fillable = [
        'booking_lokasi',
        'booking_user',
        'booking_kegiatan',
        'booking_tanggal',
        'booking_jam_mulai',
        'booking_jam_selesai',
        'booking_status',
    ];
}