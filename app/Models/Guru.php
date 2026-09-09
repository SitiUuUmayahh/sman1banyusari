<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Guru extends Model
{
    protected $table = 'guru';

    public $timestamps = false;

    protected $fillable = [
        'nama',
        'username',
        'password',
        'no_hp',
        'role',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function jadwalPikets(): HasMany
    {
        return $this->hasMany(JadwalPiket::class);
    }

    public function absensiLogsYangDiinput(): HasMany
    {
        return $this->hasMany(AbsensiLog::class, 'input_by_id')
            ->where('input_by_type', 'guru');
    }

    public function izinSakitsDiverifikasi(): HasMany
    {
        return $this->hasMany(IzinSakit::class, 'diverifikasi_oleh');
    }
}
