@extends('layouts.absensi')

@section('title', $title)

@section('content')
<div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
    <p class="text-xs font-bold uppercase tracking-[0.14em] text-slate-500">Sistem Absensi</p>
    <h1 class="mt-2 text-2xl font-bold text-slate-900">{{ $title }}</h1>
    <p class="mt-3 text-sm text-slate-600">Halaman {{ strtolower($title) }} - belum dibangun.</p>
</div>
@endsection
