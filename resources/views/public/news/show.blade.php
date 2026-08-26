@extends('layouts.app')

@section('title', $article->judul)

@section('content')
<div class="space-y-6 sm:space-y-8 max-w-4xl mx-auto">
    <!-- Back Button -->
    <a href="{{ route('news.index') }}" class="inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-500">
        <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali ke Berita
    </a>

    <!-- Article Header -->
    <div class="space-y-4">
        <p class="text-xs sm:text-sm font-medium text-slate-500 uppercase tracking-wider">
            {{ $article->published_at?->format('d M Y') }}
        </p>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900">
            {{ $article->judul }}
        </h1>
        <p class="text-base sm:text-lg text-slate-600">
            By {{ $article->adminUser?->nama ?? 'Admin' }}
        </p>
    </div>

    <!-- Featured Image -->
    @if($article->gambar_cover)
        <div class="overflow-hidden rounded-2xl bg-slate-200 aspect-video">
            <img src="{{ $article->gambar_cover ? (str_starts_with($article->gambar_cover, 'http') ? $article->gambar_cover : asset('storage/' . $article->gambar_cover)) : asset('images/placeholder.png') }}" alt="{{ $article->judul }}" loading="lazy" class="h-full w-full object-cover">
        </div>
    @endif

    <!-- Article Content -->
    <div class="prose prose-sm sm:prose-base lg:prose-lg max-w-none text-slate-700 rounded-2xl bg-white p-5 sm:p-6 lg:p-8 border border-slate-200">
        {!! $article->konten !!}
    </div>

    <!-- Navigation -->
    <div class="flex flex-col sm:flex-row gap-4 justify-between pt-6 border-t border-slate-200">
        <a href="{{ route('news.index') }}" class="inline-flex items-center justify-center rounded-lg border border-slate-300 px-6 py-3 text-base font-semibold text-slate-700 transition hover:bg-slate-50">
            Kembali ke Berita
        </a>
        <a href="{{ route('home') }}" class="inline-flex items-center justify-center rounded-lg border border-slate-300 px-6 py-3 text-base font-semibold text-slate-700 transition hover:bg-slate-50">
            Ke Beranda
        </a>
    </div>
</div>
@endsection
