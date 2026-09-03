<?php

namespace App\Http\Controllers;

use App\Models\HalamanStatis;

class SchoolController extends Controller
{
    public function greeting()
    {
        return $this->profileSection('sambutan-kepsek');
    }

    public function history()
    {
        return $this->profileSection('sejarah');
    }

    public function visionMission()
    {
        return $this->profileSection('visi-misi');
    }

    public function facilities()
    {
        return $this->profileSection('fasilitas');
    }

    public function profileSection(string $slug)
    {
        $labels = [
            'sambutan-kepsek' => 'Sambutan Kepala Sekolah',
            'sejarah' => 'Sejarah',
            'visi-misi' => 'Visi & Misi',
            'fasilitas' => 'Fasilitas',
        ];

        abort_unless(isset($labels[$slug]), 404);

        $section = HalamanStatis::where('slug', $slug)->first();

        return view('public.school.profile', [
            'section' => $section,
            'title' => $labels[$slug],
        ]);
    }
}
