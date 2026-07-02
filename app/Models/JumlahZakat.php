<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JumlahZakat extends Model
{
    use HasFactory;

    protected $fillable = [
        'jumlah_beras',
        'jumlah_uang',
        'total_beras',
        'total_uang',
        'total_distribusi',
    ];

    protected $table = 'jumlah_zakat';
}
