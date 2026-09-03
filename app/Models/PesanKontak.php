<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesanKontak extends Model
{
    protected $table = 'pesan_kontak';

    public $timestamps = false;

    protected $fillable = [
        'nama',
        'email',
        'subjek',
        'pesan',
        'sudah_dibaca',
    ];

    protected function casts(): array
    {
        return [
            'sudah_dibaca' => 'boolean',
            'created_at' => 'datetime',
        ];
    }
}
