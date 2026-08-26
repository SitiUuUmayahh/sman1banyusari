@extends('layouts.app')

@section('title', 'Informasi')

@section('content')
<div class="space-y-6 sm:space-y-8">
    <div class="text-center sm:text-left">
        <h1 class="text-3xl font-bold text-slate-900 sm:text-4xl">Informasi</h1>
        <p class="mt-2 text-slate-600">Pengumuman dan informasi penting dari sekolah.</p>
    </div>

    @if($pengumuman->count() > 0)
        <div class="grid gap-4 lg:grid-cols-2">
            @foreach($pengumuman as $item)
                <article class="flex h-full flex-col rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:border-violet-200 hover:shadow-md sm:p-5">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-violet-700">
                                {{ $item->tanggal?->format('d M Y') }}
                            </p>
                            <h2 class="mt-2 text-lg font-bold text-slate-900 sm:text-xl">{{ $item->judul }}</h2>
                        </div>
                        <span class="inline-flex items-center rounded-full bg-violet-100 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide text-violet-800">
                            Aktif
                        </span>
                    </div>

                    <div class="mt-3 text-sm leading-6 text-slate-600">
                        {!! Str::limit(strip_tags($item->konten), 180) !!}
                    </div>

                    <div class="mt-auto pt-4">
                        <a href="{{ route('informasi.show', $item->id) }}" class="inline-flex items-center text-sm font-semibold text-violet-700 transition hover:text-violet-800">
                            Baca detail <span class="ml-2">→</span>
                        </a>
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
