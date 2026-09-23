@extends('layouts.absensi-admin')

@section('title', 'Data Siswa')

@section('admin-content')
<div class="mx-auto max-w-6xl space-y-5">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
        <div><a href="{{ route('absensi.admin') }}" class="text-sm font-bold text-sky-700 hover:text-sky-900">&larr; Kembali ke dashboard</a><h1 class="mt-3 text-2xl font-extrabold text-slate-900">Data Siswa</h1><p class="mt-1 text-sm text-slate-600">Kelola data siswa secara manual.</p></div>
        <a href="{{ route('absensi.admin.siswa.create') }}" class="inline-flex min-h-12 items-center justify-center rounded-xl bg-sky-700 px-5 py-3 text-sm font-extrabold text-white hover:bg-sky-800">Tambah Siswa</a>
    </div>

    @if (session('success'))<div class="rounded-lg border-2 border-emerald-200 bg-emerald-50 p-4 text-sm font-bold text-emerald-800" role="alert">{{ session('success') }}</div>@endif

    <section class="rounded-xl border-2 border-slate-200 bg-white p-4 shadow-sm sm:p-5">
        <form method="GET" class="flex flex-col gap-3 sm:flex-row"><input name="search" value="{{ request('search') }}" type="search" placeholder="Cari NIS atau nama siswa" class="min-h-12 flex-1 rounded-lg border-2 border-slate-300 px-4 text-sm focus:border-sky-600 focus:ring-sky-600"><button class="min-h-12 rounded-lg border-2 border-slate-300 bg-white px-5 text-sm font-extrabold text-slate-700 hover:bg-slate-50">Cari</button></form>
        <div class="mt-4 overflow-x-auto"><table class="min-w-full text-left text-sm"><thead class="border-b-2 border-slate-200 text-xs uppercase text-slate-500"><tr><th class="px-3 py-3">NIS</th><th class="px-3 py-3">Nama</th><th class="px-3 py-3">Kelas</th><th class="px-3 py-3">Status</th><th class="px-3 py-3">Aksi</th></tr></thead><tbody class="divide-y divide-slate-100">@forelse ($students as $student)<tr><td class="whitespace-nowrap px-3 py-3 font-bold">{{ $student->nis }}</td><td class="px-3 py-3">{{ $student->nama }}<div class="text-xs text-slate-500">{{ $student->no_wa_ortu }}</div></td><td class="whitespace-nowrap px-3 py-3">{{ $student->kelas?->nama_kelas ?? '-' }}</td><td class="px-3 py-3"><span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-bold uppercase text-slate-700">{{ $student->status }}</span></td><td class="px-3 py-3"><div class="flex gap-2"><a href="{{ route('absensi.admin.siswa.edit', $student) }}" class="rounded-md border border-sky-300 px-3 py-2 text-xs font-bold text-sky-700 hover:bg-sky-50">Edit</a><form method="POST" action="{{ route('absensi.admin.siswa.destroy', $student) }}" onsubmit="return confirm('Hapus siswa ini beserta riwayat absensinya?')">@csrf @method('DELETE')<button class="rounded-md border border-red-300 px-3 py-2 text-xs font-bold text-red-700 hover:bg-red-50">Hapus</button></form></div></td></tr>@empty<tr><td colspan="5" class="px-3 py-8 text-center text-slate-500">Belum ada data siswa.</td></tr>@endforelse</tbody></table></div>
        <div class="mt-4">{{ $students->links() }}</div>
    </section>
</div>
@endsection
