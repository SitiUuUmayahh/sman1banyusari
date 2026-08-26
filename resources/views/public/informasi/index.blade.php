@extends('layouts.app')

@section('title', 'Informasi')

@section('content')
<div class="space-y-6 sm:space-y-8">
    <div class="text-center sm:text-left">
        <h1 class="text-3xl sm:text-4xl font-bold text-slate-900">Informasi</h1>
        <p class="mt-2 text-slate-600">Pengumuman dan informasi penting dari sekolah.</p>
    </div>

    @if($pengumuman->count() > 0)
        <div class="space-y-4">
            @foreach($pengumuman as $item)
                <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:border-violet-200 hover:shadow-md sm:p-6">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                        <div class="space-y-2">
                            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-violet-700">
                                {{ $item->tanggal?->format('d M Y') }}
                            </p>
                            <h2 class="text-xl font-bold text-slate-900 sm:text-2xl">{{ $item->judul }}</h2>
                        </div>
                        <a href="{{ route('informasi.show', $item->id) }}" class="inline-flex items-center justify-center rounded-lg border border-violet-200 bg-violet-50 px-4 py-2 text-sm font-semibold text-violet-800 transition hover:bg-violet-100">
                            Baca detail
                        </a>
                    </div>

                    <div class="mt-4 prose prose-sm max-w-none text-slate-600">
                        {!! Str::limit(strip_tags($item->konten), 220) !!}
                    </div>
                </article>
            @endforeach
        </div>

        <div class="flex justify-center pt-4">
            {{ $pengumuman->links() }}
        </div>
    @else
        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-8 text-center text-slate-600">
            Belum ada pengumuman yang dipublikasikan.
        </div>
    @endif
</div>
@endsection
