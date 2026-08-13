@extends('layouts.app')

@section('title', 'Galeri')

@section('content')
<div class="space-y-6 sm:space-y-8">
    <div class="text-center sm:text-left">
        <h1 class="text-3xl sm:text-4xl font-bold text-slate-900">Galeri Foto</h1>
        <p class="mt-2 text-slate-600">Kumpulan foto kegiatan SMAN 1 Banyusari</p>
    </div>

    @if($albums->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            @foreach($albums as $album)
                <a href="{{ route('gallery.show', $album->id) }}" class="group overflow-hidden rounded-2xl border border-slate-200 shadow-sm transition hover:shadow-lg hover:border-slate-300">
                    <div class="aspect-square overflow-hidden bg-slate-200 relative">
                        @if($album->galeriFotos->count() > 0 && $album->galeriFotos->first()->path_foto)
                            <img src="{{ $album->galeriFotos->first()->path_foto }}" alt="{{ $album->judul_album }}" loading="lazy" class="h-full w-full object-cover transition group-hover:scale-105">
                        @else
                            <div class="h-full w-full bg-gradient-to-br from-slate-300 to-slate-400 flex items-center justify-center">
                                <svg class="h-16 w-16 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 transition group-hover:opacity-100"></div>
                    </div>

                    <div class="p-4 sm:p-5">
                        <h3 class="text-lg sm:text-xl font-bold text-slate-900 line-clamp-2">
                            {{ $album->judul_album }}
                        </h3>
                        <p class="mt-2 text-sm text-slate-600">
                            {{ $album->galeriFotos->count() }} foto
                        </p>
                        <p class="mt-1 text-xs sm:text-sm text-slate-500">
                            {{ $album->tanggal?->format('d M Y') }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center pt-6 sm:pt-8">
            {{ $albums->links() }}
        </div>
    @else
        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6 sm:p-8 text-center">
            <p class="text-slate-600">Galeri belum memiliki album</p>
        </div>
    @endif
</div>
@endsection
