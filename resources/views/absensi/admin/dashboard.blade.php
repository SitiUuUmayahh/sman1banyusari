@extends('layouts.absensi-admin')

@section('title', 'Admin TU')

@section('admin-content')
<div class="mx-auto max-w-5xl space-y-6">
    <div>
        <p class="text-xs font-bold uppercase tracking-[0.14em] text-sky-700">Administrasi Absensi</p>
        <h1 class="mt-1 text-2xl font-extrabold text-slate-900">Dashboard Admin TU</h1>
        <p class="mt-2 text-sm text-slate-600">Ringkasan data utama sistem absensi.</p>
    </div>

    <div class="grid gap-4 sm:grid-cols-2">
        <div class="rounded-xl border-2 border-sky-200 bg-sky-50 p-5">
            <p class="text-sm font-bold text-sky-800">Siswa Aktif</p>
            <p class="mt-2 text-4xl font-black text-sky-950">{{ $activeStudents }}</p>
        </div>
        <div class="rounded-xl border-2 border-slate-200 bg-white p-5">
            <p class="text-sm font-bold text-slate-700">Total Kelas</p>
            <p class="mt-2 text-4xl font-black text-slate-900">{{ $classCount }}</p>
        </div>
    </div>

</div>
@endsection
