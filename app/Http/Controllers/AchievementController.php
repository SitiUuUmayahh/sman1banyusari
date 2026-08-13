<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;

class AchievementController extends Controller
{
    public function index()
    {
        $tingkats = ['sekolah', 'kabupaten', 'provinsi', 'nasional', 'internasional'];
        $filter = request('tingkat', 'semua');

        $query = Prestasi::orderBy('tahun', 'desc');

        if ($filter !== 'semua' && in_array($filter, $tingkats)) {
            $query->where('tingkat', $filter);
        }

        $achievements = $query->paginate(12);

        return view('public.achievement.index', [
            'achievements' => $achievements,
            'tingkats' => $tingkats,
            'filter' => $filter,
        ]);
    }
}
