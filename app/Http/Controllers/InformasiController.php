<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;

class InformasiController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::orderBy('tanggal', 'desc')->paginate(10);

        return view('public.informasi.index', [
            'pengumuman' => $pengumuman,
        ]);
    }

    public function show($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        return view('public.informasi.show', [
            'pengumuman' => $pengumuman,
        ]);
    }
}
