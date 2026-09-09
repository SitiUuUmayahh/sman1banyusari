<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JadwalPiket extends Model
{
    protected $table = 'jadwal_piket';

    public $timestamps = false;

    protected $fillable = [
        'guru_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
    ];

    public function guru(): BelongsTo
    {
        return $this->belongsTo(Guru::class);
    }
}
