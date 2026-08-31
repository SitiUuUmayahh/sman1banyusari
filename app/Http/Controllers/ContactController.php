<?php

namespace App\Http\Controllers;

use App\Models\PesanKontak;
use App\Models\PengaturanUmum;

class ContactController extends Controller
{
    public function index()
    {
        $settings = PengaturanUmum::getInstance();
        return view('public.contact.index', compact('settings'));
    }

    public function store()
    {
        $validated = request()->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'subjek' => 'required|string|max:255',
            'pesan' => 'required|string|min:10',
        ]);

        // Save to database
        PesanKontak::create($validated);

        return back()->with('success', 'Pesan Anda telah diterima. Terima kasih!');
    }
}
