@extends('layouts.app')

@section('title', $album->judul_album)

@section('content')
<div class="space-y-6 sm:space-y-8">
    <!-- Back Button -->
    <a href="{{ route('gallery.index') }}" class="inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-500">
        <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali ke Galeri
    </a>

    <!-- Album Header -->
    <div>
        <h1 class="text-3xl sm:text-4xl font-bold text-slate-900">{{ $album->judul_album }}</h1>
        <p class="mt-2 text-slate-600">{{ $album->tanggal?->format('d M Y') }} • {{ $album->galeriFotos->count() }} foto</p>
    </div>

    <!-- Photos Grid -->
    @if($album->galeriFotos->count() > 0)
        <div x-data="{ open: false, current: 0, photos: {{ json_encode($album->galeriFotos->map(fn($f) => ['src' => $f->path_foto ? (str_starts_with($f->path_foto, 'http') ? $f->path_foto : asset('storage/' . $f->path_foto)) : asset('images/placeholder.png'), 'caption' => $f->caption])->toArray()) }} }" class="space-y-6">
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4">
                @foreach($album->galeriFotos as $index => $foto)
                    <button
                        @click="open = true; current = {{ $index }}"
                        class="group relative overflow-hidden rounded-lg bg-slate-200 aspect-square cursor-pointer"
                    >
                        <img src="{{ $foto->path_foto ? (str_starts_with($foto->path_foto, 'http') ? $foto->path_foto : asset('storage/' . $foto->path_foto)) : asset('images/placeholder.png') }}" alt="{{ $foto->caption }}" loading="lazy" class="h-full w-full object-cover transition group-hover:scale-110">
                        <div class="absolute inset-0 bg-black/0 transition group-hover:bg-black/30 flex items-center justify-center">
                            <svg class="h-6 w-6 text-white opacity-0 transition group-hover:opacity-100" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                            </svg>
                        </div>
                    </button>
                @endforeach
            </div>

            <!-- Lightbox Modal -->
            <div
                x-show="open"
                x-transition
                @click="open = false"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black/90 p-4"
                style="display: none;"
            >
                <div class="relative max-w-4xl w-full max-h-screen" @click.stop>
                    <!-- Close Button -->
                    <button
                        @click="open = false"
                        class="absolute -top-10 right-0 text-white hover:text-slate-300 transition"
                    >
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <!-- Image -->
                    <img :src="photos[current].src" :alt="photos[current].caption" class="w-full h-auto rounded-lg">

                    <!-- Caption -->
                    <p class="mt-4 text-white text-center text-sm" x-show="photos[current].caption">
                        <span x-text="photos[current].caption"></span>
                    </p>

                    <!-- Navigation -->
                    <div class="mt-4 flex justify-between items-center text-white">
                        <button
                            @click="current = current === 0 ? photos.length - 1 : current - 1"
                            class="p-2 hover:bg-white/20 rounded-lg transition"
                        >
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>

                        <span class="text-sm">
                            <span x-text="current + 1"></span> / <span x-text="photos.length"></span>
                        </span>

                        <button
                            @click="current = current === photos.length - 1 ? 0 : current + 1"
                            class="p-2 hover:bg-white/20 rounded-lg transition"
                        >
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6 sm:p-8 text-center">
            <p class="text-slate-600">Album ini belum memiliki foto</p>
        </div>
    @endif

    <!-- Navigation -->
    <div class="flex justify-center pt-6 border-t border-slate-200">
        <a href="{{ route('gallery.index') }}" class="inline-flex items-center justify-center rounded-lg border border-slate-300 px-6 py-3 text-base font-semibold text-slate-700 transition hover:bg-slate-50">
            Kembali ke Galeri
        </a>
    </div>
</div>
@endsection
