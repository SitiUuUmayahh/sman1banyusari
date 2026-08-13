<nav x-data="{ open: false }" class="border-b border-slate-200 bg-white shadow-sm">
    <div class="container-shell">
        <div class="flex h-16 items-center justify-between gap-4 sm:h-20">
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-600 font-bold text-white shadow-sm">S</span>
                    <div class="leading-tight">
                        <div class="text-sm font-extrabold uppercase tracking-[0.2em] text-slate-900">SMAN 1</div>
                        <div class="text-[10px] font-medium text-slate-500">Banyusari</div>
                    </div>
                </a>
            </div>

            <div class="hidden items-center gap-2 md:flex">
                <a href="{{ route('home') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">Beranda</a>
                <a href="{{ route('school.profile') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">Profil</a>
                <a href="{{ route('news.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">Berita</a>
                <a href="{{ route('ppdb.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">PPDB</a>
                <a href="{{ route('gallery.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">Galeri</a>
                <a href="{{ route('achievement.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">Prestasi</a>
                <a href="{{ route('contact.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">Kontak</a>
            </div>

            <div class="hidden items-center gap-3 md:flex">
                <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 transition hover:text-slate-900">Login Admin</a>
            </div>

            <button
                type="button"
                class="inline-flex h-11 w-11 items-center justify-center rounded-lg border border-slate-200 text-slate-700 transition hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-blue-500 md:hidden"
                @click="open = !open"
                aria-label="Toggle navigation"
                aria-expanded="false"
            >
                <svg x-show="!open" x-cloak class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h16" />
                </svg>
                <svg x-show="open" x-cloak class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div x-show="open" x-transition x-cloak class="border-t border-slate-200 bg-white py-3 md:hidden">
            <div class="flex flex-col gap-1">
                <a href="{{ route('home') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">Beranda</a>
                <a href="{{ route('school.profile') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">Profil</a>
                <a href="{{ route('news.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">Berita</a>
                <a href="{{ route('ppdb.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">PPDB</a>
                <a href="{{ route('gallery.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">Galeri</a>
                <a href="{{ route('achievement.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">Prestasi</a>
                <a href="{{ route('contact.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">Kontak</a>
                <div class="mt-2 border-t border-slate-200 pt-3">
                    <a href="{{ route('login') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">Login Admin</a>
                </div>
            </div>
        </div>
    </div>
</nav>
