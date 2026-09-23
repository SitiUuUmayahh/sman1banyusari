@extends('layouts.absensi-admin')

@section('title', 'Import Data Siswa')

@section('admin-content')
<div class="mx-auto max-w-6xl space-y-6">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <a href="{{ route('absensi.admin') }}" class="text-sm font-bold text-sky-700 hover:text-sky-900">&larr; Kembali ke dashboard</a>
            <h1 class="mt-3 text-2xl font-extrabold text-slate-900">Import Data Siswa</h1>
            <p class="mt-1 text-sm text-slate-600">Upload Excel untuk menambah siswa baru atau memperbarui data siswa lama.</p>
        </div>
        <a href="{{ route('absensi.admin.import-template') }}" class="inline-flex min-h-11 items-center justify-center rounded-lg border-2 border-sky-700 bg-white px-4 py-2.5 text-sm font-extrabold text-sky-700 hover:bg-sky-50">Download Template Excel</a>
    </div>

    @if ($errors->any())
        <div class="rounded-lg border-2 border-red-200 bg-red-50 p-4 text-sm font-bold text-red-800">{{ $errors->first() }}</div>
    @endif

    @if (session('success'))
        <div class="rounded-lg border-2 border-emerald-200 bg-emerald-50 p-4 text-sm font-bold text-emerald-800" role="alert">{{ session('success') }}</div>
    @endif

    @if ($result)
        <section class="rounded-xl border-2 border-emerald-200 bg-emerald-50 p-5">
            <h2 class="text-lg font-extrabold text-emerald-900">Import selesai</h2>
            <div class="mt-3 grid gap-3 sm:grid-cols-3">
                <div class="rounded-lg bg-white p-3"><p class="text-xs font-bold text-slate-500">Ditambahkan</p><p class="mt-1 text-2xl font-black text-emerald-700">{{ $result['created'] }}</p></div>
                <div class="rounded-lg bg-white p-3"><p class="text-xs font-bold text-slate-500">Diupdate</p><p class="mt-1 text-2xl font-black text-sky-700">{{ $result['updated'] }}</p></div>
                <div class="rounded-lg bg-white p-3"><p class="text-xs font-bold text-slate-500">Gagal</p><p class="mt-1 text-2xl font-black text-red-700">{{ count($result['failed']) }}</p></div>
            </div>
            @if (count($result['failed']))
                <div class="mt-4 overflow-x-auto rounded-lg bg-white">
                    <table class="min-w-full text-left text-sm">
                        <thead class="border-b border-slate-200 text-xs uppercase text-slate-500"><tr><th class="px-3 py-2">Baris</th><th class="px-3 py-2">NIS</th><th class="px-3 py-2">Nama</th><th class="px-3 py-2">Alasan</th></tr></thead>
                        <tbody class="divide-y divide-slate-100">@foreach ($result['failed'] as $failed)<tr><td class="px-3 py-2">{{ $failed['row'] }}</td><td class="px-3 py-2">{{ $failed['nis'] ?: '-' }}</td><td class="px-3 py-2">{{ $failed['nama'] ?: '-' }}</td><td class="px-3 py-2 font-bold text-red-700">{{ $failed['reason'] }}</td></tr>@endforeach</tbody>
                    </table>
                </div>
            @endif
        </section>
    @endif

    <section class="rounded-xl border-2 border-slate-200 bg-white p-5 shadow-sm">
        <h2 class="text-lg font-extrabold text-slate-900">1. Upload File</h2>
        <form method="POST" action="{{ route('absensi.admin.import-preview') }}" enctype="multipart/form-data" class="mt-4 flex flex-col gap-3 sm:flex-row sm:items-end">
            @csrf
            <div class="flex-1"><label for="file" class="block text-sm font-bold text-slate-700">File Excel (.xlsx)</label><input id="file" name="file" type="file" accept=".xlsx" required class="mt-1.5 block min-h-12 w-full rounded-lg border-2 border-slate-300 bg-white px-3 py-2.5 text-sm"></div>
            <button type="submit" class="min-h-12 rounded-lg bg-sky-700 px-5 py-3 text-sm font-extrabold text-white hover:bg-sky-800">Tampilkan Preview</button>
        </form>
        <p class="mt-3 text-xs text-slate-500">Kolom wajib: NIS, Nama, Kelas, No WA Orang Tua. Kelas harus sudah tersedia di database.</p>
    </section>

    @if ($preview)
        <section class="rounded-xl border-2 border-slate-200 bg-white p-5 shadow-sm">
            @php
                $newCount = collect($preview)->where('type', 'new')->count();
                $updateCount = collect($preview)->where('type', 'update')->count();
                $failedCount = collect($preview)->where('type', 'failed')->count();
            @endphp
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between"><div><h2 class="text-lg font-extrabold text-slate-900">2. Preview Data</h2><p class="mt-1 text-sm text-slate-600">Data belum disimpan sampai Anda menekan konfirmasi.</p></div><div class="flex flex-wrap gap-2 text-xs font-extrabold"><span class="rounded-full bg-sky-100 px-3 py-1 text-sky-800">{{ $newCount }} BARU</span><span class="rounded-full bg-amber-100 px-3 py-1 text-amber-800">{{ $updateCount }} UPDATE</span><span class="rounded-full bg-red-100 px-3 py-1 text-red-800">{{ $failedCount }} GAGAL</span></div></div>
            <div class="mt-4 flex flex-col gap-2 sm:flex-row"><form method="POST" action="{{ route('absensi.admin.import-confirm') }}">@csrf<button type="submit" class="min-h-12 w-full rounded-lg bg-emerald-700 px-5 py-3 text-sm font-extrabold text-white hover:bg-emerald-800 sm:w-auto">Konfirmasi Import</button></form><form method="POST" action="{{ route('absensi.admin.import-cancel') }}">@csrf<button type="submit" class="min-h-12 w-full rounded-lg border-2 border-slate-300 bg-white px-5 py-3 text-sm font-extrabold text-slate-700 hover:bg-slate-50 sm:w-auto">Batal</button></form></div>
            <div class="mt-4 overflow-x-auto rounded-lg border border-slate-200"><table class="min-w-full text-left text-sm"><thead class="bg-slate-100 text-xs uppercase text-slate-600"><tr><th class="px-3 py-3">Baris</th><th class="px-3 py-3">NIS</th><th class="px-3 py-3">Nama</th><th class="px-3 py-3">Kelas</th><th class="px-3 py-3">No WA Orang Tua</th><th class="px-3 py-3">Kategori</th><th class="px-3 py-3">Perubahan / Alasan</th></tr></thead><tbody class="divide-y divide-slate-100">@foreach ($preview as $row)<tr><td class="px-3 py-3">{{ $row['row'] }}</td><td class="px-3 py-3 font-semibold">{{ $row['nis'] ?: '-' }}</td><td class="px-3 py-3">{{ $row['nama'] ?: '-' }}</td><td class="px-3 py-3">{{ $row['kelas'] ?: '-' }}</td><td class="px-3 py-3">{{ $row['no_wa_ortu'] ?: '-' }}</td><td class="px-3 py-3"><span class="rounded-full px-2.5 py-1 text-xs font-bold {{ $row['type'] === 'new' ? 'bg-sky-100 text-sky-800' : ($row['type'] === 'update' ? 'bg-amber-100 text-amber-800' : 'bg-red-100 text-red-800') }}">{{ $row['type'] === 'new' ? 'BARU' : ($row['type'] === 'update' ? 'UPDATE' : 'GAGAL') }}</span></td><td class="px-3 py-3 text-xs font-semibold text-slate-600">@if ($row['type'] === 'failed'){{ $row['reason'] }}@elseif (count($row['changes'])){{ implode(' | ', $row['changes']) }}@else Tidak ada perubahan data terdeteksi @endif</td></tr>@endforeach</tbody></table></div>
        </section>
    @endif
</div>
@endsection
