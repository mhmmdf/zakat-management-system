<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'judul',
        'thumbnail',
        'tanggal',
        'author',
        'kategori',
        'content',
    ];

    protected $table = 'articles';
}
