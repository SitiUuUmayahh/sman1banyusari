@extends('layouts.app')

@section('title', 'Berita')

@section('content')
<div class="space-y-6 sm:space-y-8">
    <div class="text-center sm:text-left">
        <h1 class="text-3xl sm:text-4xl font-bold text-slate-900">Berita</h1>
        <p class="mt-2 text-slate-600">Update informasi dan berita terkini</p>
    </div>

    @if($news->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            @foreach($news as $article)
                <article class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:shadow-lg hover:border-slate-300">
                    @if($article->gambar_cover)
                        <div class="aspect-video overflow-hidden bg-slate-200">
                            <img src="{{ $article->gambar_cover ? (str_starts_with($article->gambar_cover, 'http') ? $article->gambar_cover : asset('storage/' . $article->gambar_cover)) : asset('images/placeholder.png') }}" alt="{{ $article->judul }}" loading="lazy" class="h-full w-full object-cover transition group-hover:scale-105">
                        </div>
                    @endif

                    <div class="flex flex-col gap-3 p-4 sm:p-5 h-full">
                        <div>
                            <p class="text-xs sm:text-sm font-medium text-slate-500 uppercase tracking-wider">
                                {{ $article->published_at?->format('d M Y') }}
                            </p>
                            <h3 class="mt-2 text-lg sm:text-xl font-bold text-slate-900 line-clamp-2">
                                {{ $article->judul }}
                            </h3>
                        </div>

                        <p class="text-sm sm:text-base text-slate-600 line-clamp-3 flex-grow">
                            {{ strip_tags($article->konten) }}
                        </p>

                        <a href="{{ route('news.show', $article->slug) }}" class="inline-flex items-center text-sm font-semibold text-blue-600 transition hover:text-blue-500">
                            Baca Selengkapnya
                            <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center pt-6 sm:pt-8">
            {{ $news->links() }}
        </div>
    @else
        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6 sm:p-8 text-center">
            <p class="text-slate-600">Belum ada berita yang dipublikasikan</p>
        </div>
    @endif
</div>
@endsection
