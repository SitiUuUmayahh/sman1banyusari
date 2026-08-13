<?php

namespace App\Http\Controllers;

use App\Models\PpdbInfo;

class PpdbController extends Controller
{
    public function index()
    {
        $ppdbInfo = PpdbInfo::orderBy('tahun_ajaran', 'desc')->first();

        return view('public.ppdb.index', ['ppdbInfo' => $ppdbInfo]);
    }
}
