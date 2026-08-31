<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanUmum extends Model
{
    protected $table = 'pengaturan_umum';

    protected $fillable = [
        'alamat_sekolah',
        'email_sekolah',
        'telepon_sekolah',
        'google_maps_embed_url',
        'instagram_url',
        'facebook_url',
        'youtube_url',
        'tiktok_url',
        'jumlah_siswa_aktif',
    ];

    /**
     * Get the singleton settings record, creating it if needed.
     */
    public static function getInstance(): self
    {
        return self::firstOrCreate(
            ['id' => 1],
            ['jumlah_siswa_aktif' => 0]
        );
    }
}
