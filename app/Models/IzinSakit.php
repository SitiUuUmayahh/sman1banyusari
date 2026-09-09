<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IzinSakit extends Model
{
    protected $table = 'izin_sakit';

    public $timestamps = false;

    protected $fillable = [
        'siswa_id',
        'kategori',
        'tanggal_mulai',
        'tanggal_selesai',
        'keterangan',
        'file_lampiran',
        'status',
        'diverifikasi_oleh',
        'catatan_verifikasi',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_mulai' => 'date',
            'tanggal_selesai' => 'date',
        ];
    }

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }

    public function diverifikasiOleh(): BelongsTo
    {
        return $this->belongsTo(Guru::class, 'diverifikasi_oleh');
    }
}
