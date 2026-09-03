<nav x-data="{ open: false, scrolled: window.scrollY > 24 }" x-effect="document.body.classList.toggle('overflow-hidden', open)" @scroll.window="scrolled = window.scrollY > 24" @keydown.escape.window="open = false" @class(['home-navbar' => request()->routeIs('home'), 'relative z-40 border-b border-violet-100 bg-white/95 shadow-sm backdrop-blur' => ! request()->routeIs('home'), 'fixed inset-x-0 top-0 z-40 border-b border-transparent bg-transparent' => request()->routeIs('home')]) :class="{ 'is-scrolled': scrolled }">
    <div class="container-shell">
        <div class="flex h-16 items-center justify-between gap-4 sm:h-20">
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-violet-700 font-bold text-white shadow-sm">S</span>
                    <div class="leading-tight">
                        <div class="public-brand-name text-sm font-extrabold uppercase tracking-[0.2em] text-slate-900">SMAN 1</div>
                        <div class="public-brand-subtitle text-[10px] font-medium text-slate-500">Banyusari</div>
                    </div>
                </a>
            </div>

            <div class="public-desktop-nav hidden items-center gap-1 md:flex">
                <a href="{{ route('home') }}" class="public-nav-link rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-violet-50 hover:text-violet-800">Beranda</a>
                <div x-data="{ profileOpen: false }" @click.outside="profileOpen = false" class="relative">
                    <button type="button" @click="profileOpen = !profileOpen" class="public-nav-link inline-flex items-center gap-1 rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-violet-50 hover:text-violet-800" :aria-expanded="profileOpen.toString()" aria-haspopup="true">
                        Profil Sekolah
                        <svg class="h-4 w-4 transition-transform" :class="profileOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m6 9 6 6 6-6" /></svg>
                    </button>
                    <div x-show="profileOpen" x-transition.opacity x-cloak class="absolute left-0 top-full z-50 mt-2 w-56 overflow-hidden rounded-lg border border-slate-200 bg-white py-1 text-slate-700 shadow-lg">
                        <a href="{{ route('school.profile.greeting') }}" class="block px-4 py-3 text-sm font-medium transition hover:bg-violet-50 hover:text-violet-800">Kata Sambutan</a>
                        <a href="{{ route('school.profile.history') }}" class="block px-4 py-3 text-sm font-medium transition hover:bg-violet-50 hover:text-violet-800">Sejarah</a>
                        <a href="{{ route('school.profile.vision-mission') }}" class="block px-4 py-3 text-sm font-medium transition hover:bg-violet-50 hover:text-violet-800">Visi &amp; Misi</a>
                        <a href="{{ route('school.profile.facilities') }}" class="block px-4 py-3 text-sm font-medium transition hover:bg-violet-50 hover:text-violet-800">Fasilitas</a>
                    </div>
                </div>
                <a href="{{ route('news.index') }}" class="public-nav-link rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-violet-50 hover:text-violet-800">Berita</a>
                <a href="{{ route('informasi.index') }}" class="public-nav-link rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-violet-50 hover:text-violet-800">Informasi</a>
                <a href="{{ route('gallery.index') }}" class="public-nav-link rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-violet-50 hover:text-violet-800">Galeri</a>
                <a href="{{ route('achievement.index') }}" class="public-nav-link rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-violet-50 hover:text-violet-800">Prestasi</a>
                <a href="{{ route('contact.index') }}" class="public-nav-link rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-violet-50 hover:text-violet-800">Kontak</a>
            </div>

            <div class="hidden items-center gap-3 md:flex">
                <a href="{{ route('filament.admin.auth.login') }}" class="rounded-lg bg-violet-700 px-5 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-violet-800">Login</a>
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
                    <div x-data="{ profileOpen: false }" class="rounded-lg">
                        <button type="button" @click="profileOpen = !profileOpen" class="flex w-full items-center justify-between rounded-lg px-3 py-3 text-left text-sm font-semibold text-slate-700 hover:bg-violet-50 hover:text-violet-800" :aria-expanded="profileOpen.toString()" aria-haspopup="true">
                            <span>Profil Sekolah</span>
                            <svg class="h-4 w-4 transition-transform" :class="profileOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m6 9 6 6 6-6" /></svg>
                        </button>
                        <div x-show="profileOpen" x-transition x-cloak class="ml-3 border-l border-violet-100 pl-3">
                            <a @click="open = false" href="{{ route('school.profile.greeting') }}" class="block rounded-lg px-3 py-2.5 text-sm text-slate-600 hover:bg-violet-50 hover:text-violet-800">Kata Sambutan</a>
                            <a @click="open = false" href="{{ route('school.profile.history') }}" class="block rounded-lg px-3 py-2.5 text-sm text-slate-600 hover:bg-violet-50 hover:text-violet-800">Sejarah</a>
                            <a @click="open = false" href="{{ route('school.profile.vision-mission') }}" class="block rounded-lg px-3 py-2.5 text-sm text-slate-600 hover:bg-violet-50 hover:text-violet-800">Visi &amp; Misi</a>
                            <a @click="open = false" href="{{ route('school.profile.facilities') }}" class="block rounded-lg px-3 py-2.5 text-sm text-slate-600 hover:bg-violet-50 hover:text-violet-800">Fasilitas</a>
                        </div>
                    </div>
                    <a @click="open = false" href="{{ route('news.index') }}" class="rounded-lg px-3 py-3 text-sm font-semibold text-slate-700 hover:bg-violet-50 hover:text-violet-800">Berita</a>
                    <a @click="open = false" href="{{ route('informasi.index') }}" class="rounded-lg px-3 py-3 text-sm font-semibold text-slate-700 hover:bg-violet-50 hover:text-violet-800">Informasi</a>
                    <a @click="open = false" href="{{ route('gallery.index') }}" class="rounded-lg px-3 py-3 text-sm font-semibold text-slate-700 hover:bg-violet-50 hover:text-violet-800">Galeri</a>
                    <a @click="open = false" href="{{ route('achievement.index') }}" class="rounded-lg px-3 py-3 text-sm font-semibold text-slate-700 hover:bg-violet-50 hover:text-violet-800">Prestasi</a>
                    <a @click="open = false" href="{{ route('contact.index') }}" class="rounded-lg px-3 py-3 text-sm font-semibold text-slate-700 hover:bg-violet-50 hover:text-violet-800">Kontak</a>
                </div>
                <div class="mt-auto border-t border-violet-100 pt-5">
                    <a href="{{ route('filament.admin.auth.login') }}" class="flex items-center justify-center rounded-lg bg-violet-700 px-4 py-3 text-sm font-semibold text-white hover:bg-violet-800">Login</a>
                </div>
            </aside>
        </div>
    </div>
</nav>
