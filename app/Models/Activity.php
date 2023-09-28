<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activity';

    protected $fillable = [
        'id_user',
        'nama',
        'rencana_aktifitas',
        'laporan_aktifitas',
        'progres_harian',
        'foto1', // Kolom foto1
        'foto2', // Kolom foto2
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
