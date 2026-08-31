<?php

namespace Database\Seeders;

use App\Models\PengaturanUmum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengaturanUmumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PengaturanUmum::firstOrCreate(
            ['id' => 1],
            [
                'alamat_sekolah' => 'Jl. Pendidikan No. 1, Banyusari, Jawa Barat',
                'email_sekolah' => 'info@sman1banyusari.sch.id',
                'telepon_sekolah' => '(0221) 234-5678',
                'google_maps_embed_url' => null,
                'instagram_url' => null,
                'facebook_url' => null,
                'youtube_url' => null,
                'tiktok_url' => null,
                'jumlah_siswa_aktif' => 0,
            ]
        );
    }
}
