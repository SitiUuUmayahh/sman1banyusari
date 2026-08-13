@extends('layouts.app')

@section('title', 'PPDB Info')

@section('content')
<div class="space-y-6 sm:space-y-8 max-w-4xl mx-auto">
    <div class="text-center sm:text-left">
        <h1 class="text-3xl sm:text-4xl font-bold text-slate-900">Informasi PPDB</h1>
        <p class="mt-2 text-slate-600">Penerimaan Peserta Didik Baru</p>
    </div>

    @if($ppdbInfo)
        <div class="space-y-6">
            <!-- Tahun Ajaran -->
            <div class="rounded-2xl border border-slate-200 bg-gradient-to-br from-blue-50 to-indigo-50 p-5 sm:p-6 lg:p-8">
                <h2 class="text-lg sm:text-2xl font-bold text-slate-900">Tahun Ajaran {{ $ppdbInfo->tahun_ajaran }}</h2>
            </div>

            <!-- Jadwal -->
            <div class="rounded-2xl border border-slate-200 bg-white p-5 sm:p-6 lg:p-8">
                <h3 class="text-xl sm:text-2xl font-bold text-slate-900 mb-4">Jadwal Pendaftaran</h3>
                <div class="prose prose-sm sm:prose-base max-w-none text-slate-700">
                    {!! nl2br(e($ppdbInfo->jadwal)) !!}
                </div>
            </div>

            <!-- Syarat dan Ketentuan -->
            <div class="rounded-2xl border border-slate-200 bg-white p-5 sm:p-6 lg:p-8">
                <h3 class="text-xl sm:text-2xl font-bold text-slate-900 mb-4">Syarat dan Ketentuan</h3>
                <div class="prose prose-sm sm:prose-base max-w-none text-slate-700">
                    {!! nl2br(e($ppdbInfo->syarat)) !!}
                </div>
            </div>

            <!-- CTA Button -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center pt-4">
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center rounded-lg border border-slate-300 px-6 py-3 text-base font-semibold text-slate-700 transition hover:bg-slate-50">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    @else
        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6 sm:p-8 text-center">
            <p class="text-slate-600">Informasi PPDB belum tersedia</p>
        </div>
    @endif
</div>
@endsection
