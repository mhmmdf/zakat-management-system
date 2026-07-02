<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistribusiZakat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_mustahik',
        'jenis_zakat',
        'jumlah_beras',
        'jumlah_uang',
    ];

    protected $table = 'distribusi_zakat';
}
