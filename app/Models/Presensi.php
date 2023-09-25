<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    protected $table = 'presensi';

    protected $fillable = [
        'id_users',
        'waktu_checkin',
        // 'rencana',
        'waktu_checkout',
        'laporan',
        'status_presensi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }
}
