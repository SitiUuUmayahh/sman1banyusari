@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="space-y-6 sm:space-y-8">
    <div class="text-center sm:text-left">
        <p class="text-xs font-extrabold uppercase tracking-[0.16em] text-violet-700">Profil Sekolah</p>
        <h1 class="mt-2 text-3xl font-bold text-slate-900 sm:text-4xl">{{ $title }}</h1>
    </div>

    <section class="rounded-xl border border-violet-100 bg-white p-5 shadow-sm sm:p-7 lg:p-9">
        <div class="prose prose-sm max-w-none text-slate-700 sm:prose-base">
            @if($section)
                {!! $section->konten !!}
            @else
                <p>Konten {{ strtolower($title) }} belum tersedia.</p>
            @endif
        </div>
    </section>
</div>
@endsection
