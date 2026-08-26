<footer class="border-t border-violet-100 bg-[#eee8f3]">
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
                <a href="{{ route('ppdb.index') }}" class="hover:text-violet-800">PPDB</a>
                <a href="{{ route('contact.index') }}" class="hover:text-violet-800">Kontak Kami</a>
            </div>
        </div>
        <div>
            <h2 class="text-sm font-bold text-slate-900">Kontak</h2>
            <div class="mt-4 space-y-3 text-sm leading-5 text-slate-600">
                <p>Jl. Pendidikan No. 1, Banyusari, Jawa Barat</p>
                <a href="tel:+622212345678" class="block hover:text-violet-800">(0221) 234-5678</a>
                <a href="mailto:info@sman1banyusari.sch.id" class="block break-words hover:text-violet-800">info@sman1banyusari.sch.id</a>
            </div>
        </div>
        <a href="https://maps.google.com/?q=SMAN+1+Banyusari" target="_blank" rel="noopener" class="flex min-h-32 flex-col items-center justify-center rounded-xl border border-violet-100 bg-white/40 text-center text-sm font-semibold text-violet-900 transition hover:bg-white">
            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M9 20l-5-2.5V6.5L9 4l6 2.5L20 4v11l-5 2.5L9 20zm0-16v16m6-13.5v16" /></svg>
            <span class="mt-2">Lihat Peta</span>
        </a>
    </div>
    <div class="border-t border-violet-100 px-4 py-5 text-center text-xs text-slate-500">&copy; {{ date('Y') }} SMAN 1 Banyusari. All rights reserved.</div>
</footer>
