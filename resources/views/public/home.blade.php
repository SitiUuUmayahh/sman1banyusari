@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="space-y-14 sm:space-y-20 lg:space-y-24">
    <section class="relative isolate min-h-[30rem] overflow-hidden rounded-2xl bg-violet-950 shadow-xl sm:min-h-[34rem]">
        <img src="{{ $heroImage }}" alt="Gedung SMAN 1 Banyusari" class="absolute inset-0 -z-20 h-full w-full object-cover">
        <div class="absolute inset-0 -z-10 bg-gradient-to-r from-slate-950/85 via-violet-950/60 to-violet-950/10"></div>
        <div class="flex min-h-[30rem] max-w-2xl flex-col justify-end p-6 pb-40 text-white sm:min-h-[34rem] sm:p-10 sm:pb-40 lg:p-14 lg:pb-44">
            @if($ppdbInfo)
                <span class="w-fit rounded-full bg-amber-300 px-3 py-1 text-[10px] font-extrabold uppercase tracking-[0.12em] text-violet-950">Penerimaan Siswa Baru Dibuka</span>
            @else
                <span class="w-fit rounded-full bg-white/20 px-3 py-1 text-[10px] font-extrabold uppercase tracking-[0.12em] text-white">Selamat Datang</span>
            @endif
            <h1 class="mt-4 text-4xl font-extrabold leading-[1.05] tracking-tight sm:text-5xl lg:text-6xl">Mewujudkan Generasi Unggul &amp; Berkarakter</h1>
            <p class="mt-4 max-w-xl text-sm leading-6 text-white/85 sm:text-base">Membangun generasi cerdas, berintegritas, serta siap menghadapi tantangan global melalui pendidikan yang bermakna.</p>
            <div class="mt-7 flex flex-col gap-3 sm:flex-row">
                <a href="{{ route('ppdb.index') }}" class="inline-flex items-center justify-center rounded-lg bg-violet-700 px-5 py-3 text-sm font-bold text-white transition hover:bg-violet-600">Info PPDB <span class="ml-2">&rarr;</span></a>
                <a href="{{ route('school.profile') }}" class="inline-flex items-center justify-center rounded-lg border border-white/40 bg-white/10 px-5 py-3 text-sm font-bold text-white transition hover:bg-white/20">Pelajari Lebih Lanjut</a>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 grid grid-cols-2 divide-x divide-violet-200/40 border-t border-violet-200/30 bg-violet-950/70 backdrop-blur sm:max-w-md sm:rounded-tr-2xl">
            <div class="p-4 sm:p-5"><p class="text-2xl font-extrabold text-white">{{ $activeStudentsLabel }}</p><p class="mt-1 text-[11px] uppercase tracking-wider text-white/70">Siswa Aktif</p></div>
            <div class="p-4 sm:p-5"><p class="text-2xl font-extrabold text-white">{{ $achievementCount > 0 ? $achievementCount . '+' : 'N/A' }}</p><p class="mt-1 text-[11px] uppercase tracking-wider text-white/70">Total Prestasi</p></div>
        </div>
    </section>

    <section class="space-y-6">
        <div class="flex items-end justify-between gap-4">
            <div><span class="text-xs font-extrabold uppercase tracking-[0.16em] text-violet-700">Informasi Terkini</span><h2 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-900">Berita Terbaru</h2><p class="mt-2 text-sm text-slate-600">Kabar dan perkembangan terbaru dari sekolah.</p></div>
            <a href="{{ route('news.index') }}" class="hidden shrink-0 text-sm font-bold text-violet-800 sm:inline-flex sm:items-center">Lihat Semua Berita <span class="ml-2 text-lg">&rarr;</span></a>
        </div>
        @if($latestNews->count() > 0)
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($latestNews as $article)
                    <article class="group overflow-hidden rounded-xl border border-violet-100 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                        <div class="relative aspect-[16/10] overflow-hidden bg-violet-100">
                            @if($article->gambar_cover)<img src="{{ $article->gambar_cover }}" alt="{{ $article->judul }}" loading="lazy" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">@else<img src="{{ $heroImage }}" alt="" loading="lazy" class="h-full w-full object-cover">@endif
                            <span class="absolute left-3 top-3 rounded-full bg-white px-2.5 py-1 text-[10px] font-bold text-violet-900 shadow-sm">{{ $article->kategori ?: 'Sekolah' }}</span>
                        </div>
                        <div class="p-5"><p class="text-xs font-medium text-slate-500">{{ $article->published_at?->format('d M Y') }}</p><h3 class="mt-2 line-clamp-2 text-lg font-bold leading-6 text-slate-900">{{ $article->judul }}</h3><p class="mt-3 line-clamp-2 text-sm leading-5 text-slate-600">{{ \Illuminate\Support\Str::limit(strip_tags($article->konten), 120) }}</p><a href="{{ route('news.show', $article->slug) }}" class="mt-5 inline-flex text-sm font-bold text-violet-800">Baca Berita <span class="ml-2">&rarr;</span></a></div>
                    </article>
                @endforeach
            </div>
            <a href="{{ route('news.index') }}" class="inline-flex text-sm font-bold text-violet-800 sm:hidden">Lihat Semua Berita <span class="ml-2">&rarr;</span></a>
        @else
            <div class="rounded-xl border border-violet-100 bg-white p-8 text-center text-sm text-slate-600">Belum ada berita yang dipublikasikan.</div>
        @endif
    </section>

    <section class="-mx-4 space-y-8 bg-[#eee8f3] px-4 py-12 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div class="text-center"><span class="rounded-full bg-amber-300 px-3 py-1 text-xs font-extrabold text-violet-950">Kilas Bangga</span><h2 class="mt-4 text-3xl font-extrabold tracking-tight text-slate-900">Prestasi Gemilang Kami</h2><p class="mx-auto mt-2 max-w-xl text-sm text-slate-600">Dedikasi siswa dan guru kami membuahkan hasil yang membanggakan.</p></div>
        @if($latestAchievements->count() > 0)
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-3">
                @foreach($latestAchievements as $achievement)
                    <article class="rounded-xl border border-violet-100 bg-white p-6 text-center shadow-sm"><div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-violet-700 text-xl text-white">&#9733;</div><h3 class="mt-5 line-clamp-2 text-lg font-bold text-slate-900">{{ $achievement->judul }}</h3><p class="mt-2 text-xs font-semibold uppercase tracking-wider text-violet-700">{{ $achievement->tingkat }} &middot; {{ $achievement->tahun }}</p>@if($achievement->nama_siswa)<p class="mt-3 text-sm text-slate-600">{{ $achievement->nama_siswa }}</p>@endif</article>
                @endforeach
            </div>
        @else
            <p class="text-center text-sm text-slate-600">Belum ada data prestasi.</p>
        @endif
    </section>
</div>
@endsection
