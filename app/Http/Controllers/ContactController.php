<?php

namespace App\Http\Controllers;

class ContactController extends Controller
{
    public function index()
    {
        return view('public.contact.index');
    }

    public function store()
    {
        $validated = request()->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'subjek' => 'required|string|max:255',
            'pesan' => 'required|string|min:10',
        ]);

        \Log::info('Contact form submitted:', $validated);

        return back()->with('success', 'Pesan Anda telah diterima. Terima kasih!');
    }
}
