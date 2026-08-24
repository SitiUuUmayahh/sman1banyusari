<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\HalamanStatis;
use App\Models\PpdbInfo;
use App\Models\Prestasi;

class PublicController extends Controller
{
    public function home()
    {
        $latestNews = Berita::where('published_at', '!=', null)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        $latestAchievements = Prestasi::orderByDesc('tahun')
            ->orderByDesc('id')
            ->take(3)
            ->get();
        $achievementCount = Prestasi::count();

        $ppdbInfo = PpdbInfo::orderByDesc('tahun_ajaran')->first();
        $studentStats = HalamanStatis::where('slug', 'statistik-sekolah')->first();

        return view('public.home', [
            'latestNews' => $latestNews,
            'latestAchievements' => $latestAchievements,
            'achievementCount' => $achievementCount,
            'ppdbInfo' => $ppdbInfo,
            'activeStudents' => $studentStats?->jumlah_siswa_aktif,
            'activeStudentsLabel' => $studentStats?->jumlah_siswa_aktif
                ? number_format($studentStats->jumlah_siswa_aktif, 0, ',', '.') . '+'
                : 'N/A',
            'heroImage' => 'https://images.unsplash.com/photo-1562774053-701939374585?auto=format&fit=crop&w=1800&q=85',
        ]);
    }
}
