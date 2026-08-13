<?php

namespace App\Http\Controllers;

use App\Models\HalamanStatis;

class SchoolController extends Controller
{
    public function profile()
    {
        $sections = [
            'sambutan-kepsek' => HalamanStatis::where('slug', 'sambutan-kepsek')->first(),
            'sejarah' => HalamanStatis::where('slug', 'sejarah')->first(),
            'visi-misi' => HalamanStatis::where('slug', 'visi-misi')->first(),
            'fasilitas' => HalamanStatis::where('slug', 'fasilitas')->first(),
        ];

        return view('public.school.profile', ['sections' => $sections]);
    }
}
