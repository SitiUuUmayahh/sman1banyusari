<?php

namespace App\Models;

use App\Models\AbsensiLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QrGerbang extends Model
{
    protected $table = 'qr_gerbang';

    public $timestamps = false;

    protected $fillable = [
        'lokasi',
        'latitude',
        'longitude',
        'radius_meter',
        'token',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
        ];
    }

    public function absensiLogs(): HasMany
    {
        return $this->hasMany(AbsensiLog::class);
    }
}
