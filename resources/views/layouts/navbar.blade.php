<nav x-data="{ open: false }" x-effect="document.body.classList.toggle('overflow-hidden', open)" @keydown.escape.window="open = false" class="relative z-40 border-b border-violet-100 bg-white/95 shadow-sm backdrop-blur">
    <div class="container-shell">
        <div class="flex h-16 items-center justify-between gap-4 sm:h-20">
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-violet-700 font-bold text-white shadow-sm">S</span>
                    <div class="leading-tight">
                        <div class="text-sm font-extrabold uppercase tracking-[0.2em] text-slate-900">SMAN 1</div>
                        <div class="text-[10px] font-medium text-slate-500">Banyusari</div>
                    </div>
                </a>
            </div>

            <div class="hidden items-center gap-1 md:flex">
                <a href="{{ route('home') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-violet-50 hover:text-violet-800">Beranda</a>
                <a href="{{ route('school.profile') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-violet-50 hover:text-violet-800">Profil</a>
                <a href="{{ route('news.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-violet-50 hover:text-violet-800">Berita</a>
                <a href="{{ route('informasi.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-violet-50 hover:text-violet-800">Informasi</a>
                <a href="{{ route('ppdb.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-violet-50 hover:text-violet-800">PPDB</a>
                <a href="{{ route('gallery.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-violet-50 hover:text-violet-800">Galeri</a>
                <a href="{{ route('achievement.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-violet-50 hover:text-violet-800">Prestasi</a>
                <a href="{{ route('contact.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-violet-50 hover:text-violet-800">Kontak</a>
            </div>

            <div class="hidden items-center gap-3 md:flex">
                <a href="{{ route('login') }}" class="rounded-lg bg-violet-700 px-5 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-violet-800">Login</a>
            </div>

            <button
                type="button"
                class="inline-flex h-11 w-11 items-center justify-center rounded-lg border border-violet-200 text-violet-800 transition hover:bg-violet-50 focus:outline-none focus:ring-2 focus:ring-violet-500 md:hidden"
                @click="open = !open"
                aria-label="Buka menu"
                :aria-expanded="open.toString()"
            >
                <svg x-show="!open" x-cloak class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h16" />
                </svg>
                <svg x-show="open" x-cloak class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div x-show="open" x-transition.opacity x-cloak class="fixed inset-0 top-0 bg-slate-950/30 md:hidden" @click="open = false">
            <aside x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" @click.stop class="absolute right-0 top-0 flex h-full w-[min(86vw,22rem)] flex-col bg-white p-5 shadow-2xl">
                <div class="flex items-center justify-between border-b border-violet-100 pb-5">
                    <span class="text-sm font-extrabold uppercase tracking-[0.18em] text-violet-900">Menu</span>
                    <button type="button" @click="open = false" class="inline-flex h-10 w-10 items-center justify-center rounded-lg text-slate-600 hover:bg-violet-50 hover:text-violet-800" aria-label="Tutup menu">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                <div class="flex flex-col gap-1 pt-5">
                    <a @click="open = false" href="{{ route('home') }}" class="rounded-lg px-3 py-3 text-sm font-semibold text-slate-700 hover:bg-violet-50 hover:text-violet-800">Beranda</a>
                    <a @click="open = false" href="{{ route('school.profile') }}" class="rounded-lg px-3 py-3 text-sm font-semibold text-slate-700 hover:bg-violet-50 hover:text-violet-800">Profil</a>
                    <a @click="open = false" href="{{ route('news.index') }}" class="rounded-lg px-3 py-3 text-sm font-semibold text-slate-700 hover:bg-violet-50 hover:text-violet-800">Berita</a>
                    <a @click="open = false" href="{{ route('informasi.index') }}" class="rounded-lg px-3 py-3 text-sm font-semibold text-slate-700 hover:bg-violet-50 hover:text-violet-800">Informasi</a>
                    <a @click="open = false" href="{{ route('ppdb.index') }}" class="rounded-lg px-3 py-3 text-sm font-semibold text-slate-700 hover:bg-violet-50 hover:text-violet-800">PPDB</a>
                    <a @click="open = false" href="{{ route('gallery.index') }}" class="rounded-lg px-3 py-3 text-sm font-semibold text-slate-700 hover:bg-violet-50 hover:text-violet-800">Galeri</a>
                    <a @click="open = false" href="{{ route('achievement.index') }}" class="rounded-lg px-3 py-3 text-sm font-semibold text-slate-700 hover:bg-violet-50 hover:text-violet-800">Prestasi</a>
                    <a @click="open = false" href="{{ route('contact.index') }}" class="rounded-lg px-3 py-3 text-sm font-semibold text-slate-700 hover:bg-violet-50 hover:text-violet-800">Kontak</a>
                </div>
                <div class="mt-auto border-t border-violet-100 pt-5">
                    <a href="{{ route('login') }}" class="flex items-center justify-center rounded-lg bg-violet-700 px-4 py-3 text-sm font-semibold text-white hover:bg-violet-800">Login</a>
                </div>
            </aside>
        </div>
    </div>
</nav>
