<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\HalamanStatis;
use App\Models\Pengumuman;
use App\Models\Prestasi;

class PublicController extends Controller
{
    public function home()
    {
        $latestNews = Berita::where('published_at', '!=', null)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        $latestAnnouncements = Pengumuman::aktif()
            ->orderByDesc('tanggal')
            ->orderByDesc('id')
            ->take(3)
            ->get();

        $latestAnnouncement = Pengumuman::aktif()
            ->orderByDesc('tanggal')
            ->orderByDesc('id')
            ->first();

        $latestAchievements = Prestasi::orderByDesc('tahun')
            ->orderByDesc('id')
            ->take(3)
            ->get();
        $achievementCount = Prestasi::count();

        $studentStats = HalamanStatis::where('slug', 'statistik-sekolah')->first();

        return view('public.home', [
            'latestNews' => $latestNews,
            'latestAnnouncements' => $latestAnnouncements,
            'latestAnnouncement' => $latestAnnouncement,
            'latestAchievements' => $latestAchievements,
            'achievementCount' => $achievementCount,
            'activeStudents' => $studentStats?->jumlah_siswa_aktif,
            'activeStudentsLabel' => $studentStats?->jumlah_siswa_aktif
                ? number_format($studentStats->jumlah_siswa_aktif, 0, ',', '.') . '+'
                : 'N/A',
            // Ganti URL ini dengan foto gedung sekolah Anda sendiri.
            // Bisa pakai URL Unsplash, CDN, atau path file lokal di storage/public.
            'heroImage' => asset('images/sman1banyusari.png'),
        ]);
    }
}
