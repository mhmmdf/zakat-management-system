<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengumpulanZakat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_muzakki',
        'jumlah_tanggungan',
        'jenis_bayar',
        'jumlah_tanggungandibayar',
        'bayar_beras',
        'bayar_uang',
    ];

    protected $table = 'pengumpulan_zakat';
}
