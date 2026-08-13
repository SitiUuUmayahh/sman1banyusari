@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="space-y-12 sm:space-y-16 lg:space-y-20">
    <!-- Hero Section -->
    <section class="space-y-4 sm:space-y-6 lg:space-y-8">
        <div class="text-center">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900">
                Selamat Datang di SMAN 1 Banyusari
            </h1>
            <p class="mt-3 sm:mt-4 text-base sm:text-lg text-slate-600 max-w-2xl mx-auto">
                Membangun generasi unggul melalui pendidikan berkualitas dan inovasi berkelanjutan
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center pt-4 sm:pt-6">
            <a href="{{ route('ppdb.index') }}" class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-6 sm:px-8 py-3 sm:py-4 text-base sm:text-lg font-semibold text-white shadow-md transition hover:bg-blue-500 active:scale-95">
                Daftar PPDB
            </a>
            <a href="{{ route('school.profile') }}" class="inline-flex items-center justify-center rounded-lg border border-slate-300 px-6 sm:px-8 py-3 sm:py-4 text-base sm:text-lg font-semibold text-slate-700 transition hover:border-slate-400 hover:bg-slate-50">
                Pelajari Lebih Lanjut
            </a>
        </div>
    </section>

    <!-- Latest News Section -->
    <section class="space-y-6 sm:space-y-8">
        <div class="text-center sm:text-left">
            <h2 class="text-2xl sm:text-3xl font-bold text-slate-900">Berita Terbaru</h2>
            <p class="mt-2 text-slate-600">Informasi dan update terkini dari SMAN 1 Banyusari</p>
        </div>

        @if($latestNews->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                @foreach($latestNews as $article)
                    <article class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:shadow-lg hover:border-slate-300">
                        @if($article->gambar_cover)
                            <div class="aspect-video overflow-hidden bg-slate-200">
                                <img src="{{ $article->gambar_cover }}" alt="{{ $article->judul }}" loading="lazy" class="h-full w-full object-cover transition group-hover:scale-105">
                            </div>
                        @endif

                        <div class="flex flex-col gap-3 p-4 sm:p-5">
                            <div>
                                <p class="text-xs sm:text-sm font-medium text-slate-500 uppercase tracking-wider">
                                    {{ $article->published_at?->format('d M Y') }}
                                </p>
                                <h3 class="mt-2 text-lg sm:text-xl font-bold text-slate-900 line-clamp-2">
                                    {{ $article->judul }}
                                </h3>
                            </div>

                            <p class="text-sm sm:text-base text-slate-600 line-clamp-2">
                                {{ strip_tags($article->konten) }}
                            </p>

                            <a href="{{ route('news.show', $article->slug) }}" class="mt-auto inline-flex items-center text-sm font-semibold text-blue-600 transition hover:text-blue-500">
                                Baca Selengkapnya
                                <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="flex justify-center pt-4 sm:pt-6">
                <a href="{{ route('news.index') }}" class="inline-flex items-center rounded-lg border border-slate-300 px-6 py-3 text-base font-semibold text-slate-700 transition hover:bg-slate-50">
                    Lihat Semua Berita
                </a>
            </div>
        @else
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6 sm:p-8 text-center">
                <p class="text-slate-600">Belum ada berita yang dipublikasikan</p>
            </div>
        @endif
    </section>
</div>
@endsection
