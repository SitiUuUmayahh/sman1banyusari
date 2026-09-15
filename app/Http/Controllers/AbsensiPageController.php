<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AbsensiPageController extends Controller
{
    public function scan(): View
    {
        return view('absensi.page', ['title' => 'Scan Absensi']);
    }

    public function piket(): View
    {
        return view('absensi.page', ['title' => 'Piket']);
    }

    public function admin(): View
    {
        return view('absensi.page', ['title' => 'Admin']);
    }

    public function laporan(): View
    {
        return view('absensi.page', ['title' => 'Laporan']);
    }
}
