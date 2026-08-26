<?php

namespace Database\Seeders;

use App\Models\HalamanStatis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HalamanStatisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            'sambutan-kepsek' => 'Sambutan Kepala Sekolah',
            'sejarah' => 'Sejarah',
            'visi-misi' => 'Visi & Misi',
            'fasilitas' => 'Fasilitas',
        ];

        foreach ($pages as $slug => $judul) {
            HalamanStatis::firstOrCreate(
                ['slug' => $slug],
                [
                    'judul' => $judul,
                    'konten' => 'Konten belum diisi, silakan edit halaman ini',
                ],
            );
        }
    }
}
