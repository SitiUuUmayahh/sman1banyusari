<footer class="border-t border-violet-100 bg-[#eee8f3]">
    @php
        $settings = App\Models\PengaturanUmum::getInstance();
    @endphp
    <div class="container-shell grid gap-8 py-10 sm:grid-cols-2 lg:grid-cols-4 lg:py-12">
        <div>
            <p class="text-sm font-extrabold uppercase tracking-[0.16em] text-violet-900">SMAN 1 Banyusari</p>
            <p class="mt-4 max-w-xs text-sm leading-6 text-slate-600">Mencerdaskan kehidupan bangsa melalui pendidikan berkualitas, berintegritas, dan berkarakter.</p>
        </div>
        <div>
            <h2 class="text-sm font-bold text-slate-900">Tautan Penting</h2>
            <div class="mt-4 flex flex-col gap-2 text-sm text-slate-600">
                <a href="{{ route('school.profile') }}" class="hover:text-violet-800">Profil Sekolah</a>
                <a href="{{ route('news.index') }}" class="hover:text-violet-800">Berita</a>
                <a href="{{ route('informasi.index') }}" class="hover:text-violet-800">Informasi</a>
                <a href="{{ route('contact.index') }}" class="hover:text-violet-800">Kontak Kami</a>
            </div>
        </div>
        <div>
            <h2 class="text-sm font-bold text-slate-900">Kontak</h2>
            <div class="mt-4 space-y-3 text-sm leading-5 text-slate-600">
                @if($settings->alamat_sekolah)
                    <p>{{ $settings->alamat_sekolah }}</p>
                @endif
                @if($settings->telepon_sekolah)
                    <a href="tel:{{ str_replace([' ', '-', '(', ')'], '', $settings->telepon_sekolah) }}" class="block hover:text-violet-800">{{ $settings->telepon_sekolah }}</a>
                @endif
                @if($settings->email_sekolah)
                    <a href="mailto:{{ $settings->email_sekolah }}" class="block break-words hover:text-violet-800">{{ $settings->email_sekolah }}</a>
                @endif
            </div>
        </div>
        <div class="space-y-4">
            @if($settings->instagram_url || $settings->facebook_url || $settings->youtube_url || $settings->tiktok_url)
                <div class="flex flex-col gap-3">
                    @if($settings->instagram_url)
                        <a href="{{ $settings->instagram_url }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-sm text-slate-600 hover:text-violet-800">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073z"/></svg>
                            Instagram
                        </a>
                    @endif
                    @if($settings->facebook_url)
                        <a href="{{ $settings->facebook_url }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-sm text-slate-600 hover:text-violet-800">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            Facebook
                        </a>
                    @endif
                    @if($settings->youtube_url)
                        <a href="{{ $settings->youtube_url }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-sm text-slate-600 hover:text-violet-800">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                            YouTube
                        </a>
                    @endif
                    @if($settings->tiktok_url)
                        <a href="{{ $settings->tiktok_url }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-sm text-slate-600 hover:text-violet-800">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.498 15.25v-8.49c0-2.82-.99-5.47-3.04-7.5h-4.88v15.29c-.1.59-.64 1.04-1.3 1.04-.71 0-1.28-.57-1.28-1.28s.57-1.28 1.28-1.28c.37 0 .7.16.94.42v-4.23c-.29-.05-.58-.07-.88-.07-2.75 0-4.99 2.24-4.99 4.99 0 2.75 2.24 4.99 4.99 4.99 2.37 0 4.38-1.66 4.84-3.87V5.59c1.05 1.16 1.76 2.74 1.76 4.44v4.16c0 .11.01.22.03.33.28 1.46 1.53 2.57 3.04 2.57 1.71 0 3.1-1.39 3.1-3.1z"/></svg>
                            TikTok
                        </a>
                    @endif
                </div>
            @endif
            <a href="https://maps.google.com/?q=SMAN+1+Banyusari" target="_blank" rel="noopener" class="flex min-h-32 flex-col items-center justify-center rounded-xl border border-violet-100 bg-white/40 text-center text-sm font-semibold text-violet-900 transition hover:bg-white">
                <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M9 20l-5-2.5V6.5L9 4l6 2.5L20 4v11l-5 2.5L9 20zm0-16v16m6-13.5v16" /></svg>
                <span class="mt-2">Lihat Peta</span>
            </a>
        </div>
    </div>
    <div class="border-t border-violet-100 px-4 py-5 text-center text-xs text-slate-500">&copy; {{ date('Y') }} SMAN 1 Banyusari. All rights reserved.</div>
</footer>
