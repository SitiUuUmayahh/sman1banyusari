<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    public function index(Request $request)
    {
        $tingkats = ['sekolah', 'kabupaten', 'provinsi', 'nasional', 'internasional'];
        $filter = $request->query('tingkat', 'semua');

        $query = Prestasi::orderBy('tahun', 'desc');

        if ($filter !== 'semua' && in_array($filter, $tingkats, true)) {
            $query->where('tingkat', $filter);
        } else {
            $filter = 'semua';
        }

        $achievements = $query->paginate(12);

        return view('public.achievement.index', [
            'achievements' => $achievements,
            'tingkats' => $tingkats,
            'filter' => $filter,
        ]);
    }
}
