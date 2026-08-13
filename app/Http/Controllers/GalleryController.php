<?php

namespace App\Http\Controllers;

use App\Models\GaleriAlbum;

class GalleryController extends Controller
{
    public function index()
    {
        $albums = GaleriAlbum::orderBy('tanggal', 'desc')->paginate(12);

        return view('public.gallery.index', ['albums' => $albums]);
    }

    public function show($id)
    {
        $album = GaleriAlbum::with('galeriFotos')->findOrFail($id);

        return view('public.gallery.show', ['album' => $album]);
    }
}
