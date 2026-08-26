<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';

    public $timestamps = false;

    protected $fillable = [
        'judul',
        'konten',
        'tanggal',
        'tanggal_selesai',
        'admin_id',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'tanggal_selesai' => 'date',
        ];
    }

    public function isAktif(): bool
    {
        $today = now()->toDateString();
        $tanggalMulai = $this->tanggal?->toDateString();
        $tanggalSelesai = $this->tanggal_selesai?->toDateString();

        if ($tanggalMulai && $tanggalSelesai) {
            return $today >= $tanggalMulai && $today <= $tanggalSelesai;
        }

        if ($tanggalMulai) {
            return $today >= $tanggalMulai;
        }

        if ($tanggalSelesai) {
            return $today <= $tanggalSelesai;
        }

        return true;
    }

    public function scopeAktif(Builder $query): Builder
    {
        $today = now()->toDateString();

        return $query->where(function (Builder $subQuery) use ($today) {
            $subQuery->where(function (Builder $inner) use ($today) {
                $inner->whereNotNull('tanggal')
                    ->whereDate('tanggal', '<=', $today);
            })->where(function (Builder $range) use ($today) {
                $range->whereNull('tanggal_selesai')
                    ->orWhereDate('tanggal_selesai', '>=', $today);
            });
        })->orWhere(function (Builder $subQuery) use ($today) {
            $subQuery->whereNull('tanggal_selesai')
                ->whereNotNull('tanggal')
                ->whereDate('tanggal', '<=', $today);
        });
    }

    public function scopeArsip(Builder $query): Builder
    {
        return $query->whereNot(fn (Builder $subQuery) => $subQuery->aktif());
    }

    public function adminUser(): BelongsTo
    {
        return $this->belongsTo(AdminUser::class, 'admin_id', 'id');
    }
}
