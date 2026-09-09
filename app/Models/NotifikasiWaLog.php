<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotifikasiWaLog extends Model
{
    protected $table = 'notifikasi_wa_log';

    public $timestamps = false;

    protected $fillable = [
        'absensi_log_id',
        'no_tujuan',
        'pesan',
        'status_kirim',
        'dikirim_at',
    ];

    protected function casts(): array
    {
        return [
            'dikirim_at' => 'datetime',
        ];
    }

    public function absensiLog(): BelongsTo
    {
        return $this->belongsTo(AbsensiLog::class);
    }
}
