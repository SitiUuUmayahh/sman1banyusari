<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AbsensiLog extends Model
{
    protected $table = 'absensi_log';

    public $timestamps = false;

    protected $fillable = [
        'siswa_id',
        'tanggal',
        'jam_masuk',
        'status_masuk',
        'jam_pulang',
        'latitude_scan',
        'longitude_scan',
        'qr_gerbang_id',
        'input_by_type',
        'input_by_id',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'jam_masuk' => 'datetime',
            'jam_pulang' => 'datetime',
            'latitude_scan' => 'decimal:7',
            'longitude_scan' => 'decimal:7',
        ];
    }

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }

    public function qrGerbang(): BelongsTo
    {
        return $this->belongsTo(QrGerbang::class);
    }

    public function notifikasiWaLog(): HasOne
    {
        return $this->hasOne(NotifikasiWaLog::class);
    }

    public function inputBy(): ?Model
    {
        return match ($this->input_by_type) {
            'siswa' => $this->input_by_id ? Siswa::find($this->input_by_id) : null,
            'guru' => $this->input_by_id ? Guru::find($this->input_by_id) : null,
            default => null,
        };
    }
}
