<?php

namespace App\Http\Controllers;

use App\Models\Berita;

class PublicController extends Controller
{
    public function home()
    {
        $latestNews = Berita::where('published_at', '!=', null)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        return view('public.home', [
            'latestNews' => $latestNews,
        ]);
    }
}
