@extends('layouts.app')

@section('title', $pengumuman->judul)

@section('content')
<div class="mx-auto max-w-4xl space-y-6 sm:space-y-8">
    <a href="{{ route('informasi.index') }}" class="inline-flex items-center text-sm font-semibold text-violet-700 hover:text-violet-800">
        <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali ke Informasi
    </a>

    <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-8">
        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-violet-700">
            {{ $pengumuman->tanggal?->format('d M Y') }}
        </p>

        <h1 class="mt-4 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
            {{ $pengumuman->judul }}
        </h1>

        <div class="mt-6 prose prose-sm max-w-none text-slate-700 sm:prose-base">
            {!! $pengumuman->konten !!}
        </div>
    </article>
</div>
@endsection
