<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HalamanStatis extends Model
{
    protected $table = 'halaman_statis';

    public $timestamps = false;

    protected $fillable = [
        'slug',
        'judul',
        'konten',
        'jumlah_siswa_aktif',
    ];
}
