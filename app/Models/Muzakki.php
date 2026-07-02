<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Muzakki extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_muzakki',
        'jumlah_tanggungan',
        'alamat',
        'handphone',
        'nomor_kk',
    ];

    protected $table = 'muzakki';
}
