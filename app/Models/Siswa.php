<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Siswa extends Authenticatable
{
    protected $table = 'siswa';

    public $timestamps = false;

    protected $fillable = [
        'nis',
        'nama',
        'password',
        'kelas_id',
        'no_wa_ortu',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }

    public function absensiLogs(): HasMany
    {
        return $this->hasMany(AbsensiLog::class);
    }

    public function izinSakits(): HasMany
    {
        return $this->hasMany(IzinSakit::class);
    }
}
