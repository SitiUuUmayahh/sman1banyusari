<?php

namespace App\Http\Controllers;

use App\Models\Berita;

class NewsController extends Controller
{
    public function index()
    {
        $news = Berita::where('published_at', '!=', null)
            ->orderBy('published_at', 'desc')
            ->paginate(12);

        return view('public.news.index', ['news' => $news]);
    }

    public function show($slug)
    {
        $article = Berita::where('slug', $slug)->firstOrFail();

        return view('public.news.show', ['article' => $article]);
    }
}
