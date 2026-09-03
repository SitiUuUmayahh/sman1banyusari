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
                <a href="{{ route('school.profile.greeting') }}" class="hover:text-violet-800">Profil Sekolah</a>
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
                <div>
                    <h2 class="text-sm font-bold text-slate-900">Media Sosial</h2>
                    <div class="mt-4 flex flex-wrap items-center gap-3">
                        @if($settings->instagram_url)
                            <a href="{{ $settings->instagram_url }}" target="_blank" rel="noopener" aria-label="Instagram" class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-br from-purple-500 via-pink-500 to-orange-400 text-white shadow-sm transition hover:scale-105 hover:shadow-md">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M7 2h10a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5V7a5 5 0 0 1 5-5zm0 2a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3H7zm5 3.5A4.5 4.5 0 1 1 7.5 12 4.5 4.5 0 0 1 12 7.5zm0 2A2.5 2.5 0 1 0 14.5 12 2.5 2.5 0 0 0 12 9.5zm5-3.25a1.25 1.25 0 1 1-1.25 1.25A1.25 1.25 0 0 1 17 6.25z"/></svg>
                            </a>
                        @endif
                        @if($settings->facebook_url)
                            <a href="{{ $settings->facebook_url }}" target="_blank" rel="noopener" aria-label="Facebook" class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-blue-600 text-white shadow-sm transition hover:scale-105 hover:shadow-md">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M13.5 22v-8h2.5l.5-3h-3V7.5c0-.9.4-1.5 1.5-1.5H16V3.2c-.5-.1-1.4-.2-2.6-.2-2.4 0-4.1 1.5-4.1 4.2V11H7v3h2.3v8h4.2z"/></svg>
                            </a>
                        @endif
                        @if($settings->youtube_url)
                            <a href="{{ $settings->youtube_url }}" target="_blank" rel="noopener" aria-label="YouTube" class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-red-600 text-white shadow-sm transition hover:scale-105 hover:shadow-md">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.5 12c0-1.4-.1-2.8-.4-4.1-.5-2-2.1-3.6-4.1-4.1C17.8 3.5 15.4 3 12 3s-5.8.5-7 .8c-2 .5-3.6 2.1-4.1 4.1C.5 9.2.4 10.6.4 12c0 1.4.1 2.8.4 4.1.5 2 2.1 3.6 4.1 4.1 1.2.3 3.6.8 7 .8s5.8-.5 7-.8c2-.5 3.6-2.1 4.1-4.1.3-1.3.4-2.7.4-4.1zm-13.5 4.6V7.4L17 12l-7 4.6z"/></svg>
                            </a>
                        @endif
                        @if($settings->tiktok_url)
                            <a href="{{ $settings->tiktok_url }}" target="_blank" rel="noopener" aria-label="TikTok" class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-slate-900 text-white shadow-sm transition hover:scale-105 hover:shadow-md">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M16.7 3c.2 1.6 1.2 2.9 2.9 3.3v2.4c-1.1 0-2.1-.3-3.1-.9v6.2a4.7 4.7 0 1 1-4.7-4.7c.2 0 .4 0 .7.1v2.5a2.2 2.2 0 1 0 1.5 2.1V3h3.7z"/></svg>
                            </a>
                        @endif
                    </div>
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
