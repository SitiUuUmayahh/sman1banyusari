@extends('layouts.absensi-admin')

@section('title', 'Export Laporan')

@section('admin-content')
<div class="mx-auto max-w-6xl space-y-5">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900">Export Laporan Absensi</h1>
        <p class="mt-1 text-sm text-slate-600">Tinjau ringkasan kehadiran sebelum mengunduh Excel.</p>
    </div>

    @if ($errors->any())
        <div class="rounded-lg border-2 border-red-200 bg-red-50 p-4 text-sm font-bold text-red-800">{{ $errors->first() }}</div>
    @endif

    <section class="rounded-xl border-2 border-slate-200 bg-white p-4 shadow-sm sm:p-5">
        <form method="GET" action="{{ route('absensi.admin.laporan') }}" class="grid gap-4 md:grid-cols-4 md:items-end">
            <div><label for="dari" class="block text-sm font-bold text-slate-700">Dari tanggal</label><input id="dari" name="dari" type="date" value="{{ $from }}" required class="mt-1.5 min-h-12 w-full rounded-lg border-2 border-slate-300 px-3 text-sm focus:border-sky-600 focus:ring-sky-600"></div>
            <div><label for="sampai" class="block text-sm font-bold text-slate-700">Sampai tanggal</label><input id="sampai" name="sampai" type="date" value="{{ $to }}" required class="mt-1.5 min-h-12 w-full rounded-lg border-2 border-slate-300 px-3 text-sm focus:border-sky-600 focus:ring-sky-600"></div>
            <div><label for="kelas_id" class="block text-sm font-bold text-slate-700">Kelas</label><select id="kelas_id" name="kelas_id" class="mt-1.5 min-h-12 w-full rounded-lg border-2 border-slate-300 px-3 text-sm focus:border-sky-600 focus:ring-sky-600"><option value="">Semua Kelas</option>@foreach($classes as $class)<option value="{{ $class->id }}" @selected($selectedClass === $class->id)>{{ $class->nama_kelas }}</option>@endforeach</select></div>
            <button class="min-h-12 rounded-lg bg-slate-800 px-4 py-3 text-sm font-extrabold text-white hover:bg-slate-900">Tampilkan Preview</button>
        </form>
    </section>

    <section class="rounded-xl border-2 border-slate-200 bg-white p-4 shadow-sm sm:p-5">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between"><div><h2 class="text-lg font-extrabold text-slate-900">Preview Ringkasan</h2><p class="mt-1 text-sm text-slate-600">{{ $from }} sampai {{ $to }}{{ $selectedClass ? ' • kelas terpilih' : ' • semua kelas' }}</p></div><a href="{{ route('absensi.admin.laporan.export', request()->query()) }}" class="inline-flex min-h-12 items-center justify-center rounded-lg bg-emerald-700 px-5 py-3 text-sm font-extrabold text-white hover:bg-emerald-800">Export ke Excel</a></div>
        <div class="mt-4 hidden overflow-x-auto rounded-lg border border-slate-200 md:block"><table class="min-w-full text-left text-sm"><thead class="bg-slate-100 text-xs uppercase text-slate-600"><tr><th class="px-4 py-3">Nama Siswa</th><th class="px-4 py-3">Kelas</th><th class="px-4 py-3">Total Hadir</th><th class="px-4 py-3">Total Terlambat</th><th class="px-4 py-3">Total Alpa</th></tr></thead><tbody class="divide-y divide-slate-100">@forelse($rows as $row)<tr><td class="px-4 py-3 font-bold">{{ $row['nama'] }}</td><td class="px-4 py-3">{{ $row['kelas'] }}</td><td class="px-4 py-3 font-bold text-emerald-700">{{ $row['hadir'] }}</td><td class="px-4 py-3 font-bold text-amber-700">{{ $row['terlambat'] }}</td><td class="px-4 py-3 font-bold text-red-700">{{ $row['alpa'] }}</td></tr>@empty<tr><td colspan="5" class="px-4 py-8 text-center text-slate-500">Tidak ada data siswa.</td></tr>@endforelse</tbody></table></div>
        <div class="mt-4 space-y-3 md:hidden">@forelse($rows as $row)<article class="rounded-lg border-2 border-slate-200 p-4"><p class="font-extrabold text-slate-900">{{ $row['nama'] }}</p><p class="mt-1 text-xs font-semibold text-slate-500">{{ $row['kelas'] }}</p><div class="mt-3 grid grid-cols-3 gap-2 text-center"><div class="rounded bg-emerald-50 p-2"><p class="text-lg font-black text-emerald-700">{{ $row['hadir'] }}</p><p class="text-[10px] font-bold text-emerald-800">Hadir</p></div><div class="rounded bg-amber-50 p-2"><p class="text-lg font-black text-amber-700">{{ $row['terlambat'] }}</p><p class="text-[10px] font-bold text-amber-800">Terlambat</p></div><div class="rounded bg-red-50 p-2"><p class="text-lg font-black text-red-700">{{ $row['alpa'] }}</p><p class="text-[10px] font-bold text-red-800">Alpa</p></div></div></article>@empty<p class="py-8 text-center text-sm text-slate-500">Tidak ada data siswa.</p>@endforelse</div>
    </section>
</div>
@endsection
