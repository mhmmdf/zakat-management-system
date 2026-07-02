<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mustahik extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_mustahik',
        'kategori_mustahik',
        'jumlah_hak',
        'alamat',
        'handphone',
        'nomor_kk',
    ];

    protected $table = 'mustahik';
}
