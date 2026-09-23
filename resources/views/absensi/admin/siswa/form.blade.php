@extends('layouts.absensi-admin')

@section('title', $student->exists ? 'Edit Siswa' : 'Tambah Siswa')

@section('admin-content')
<div class="mx-auto max-w-2xl space-y-5">
    <div><a href="{{ route('absensi.admin.siswa.index') }}" class="text-sm font-bold text-sky-700 hover:text-sky-900">&larr; Kembali ke data siswa</a><h1 class="mt-3 text-2xl font-extrabold text-slate-900">{{ $student->exists ? 'Edit Siswa' : 'Tambah Siswa' }}</h1></div>
    @if ($errors->any())<div class="rounded-lg border-2 border-red-200 bg-red-50 p-4 text-sm font-bold text-red-800"><ul class="list-inside list-disc">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
    <form method="POST" action="{{ $student->exists ? route('absensi.admin.siswa.update', $student) : route('absensi.admin.siswa.store') }}" class="space-y-5 rounded-xl border-2 border-slate-200 bg-white p-5 shadow-sm sm:p-7">
        @csrf
        @if ($student->exists) @method('PUT') @endif
        <div><label for="nis" class="block text-sm font-bold text-slate-700">NIS</label><input id="nis" name="nis" value="{{ old('nis', $student->nis) }}" required class="mt-1.5 min-h-12 block w-full rounded-lg border-2 border-slate-300 px-4 text-sm focus:border-sky-600 focus:ring-sky-600"></div>
        <div><label for="nama" class="block text-sm font-bold text-slate-700">Nama</label><input id="nama" name="nama" value="{{ old('nama', $student->nama) }}" required class="mt-1.5 min-h-12 block w-full rounded-lg border-2 border-slate-300 px-4 text-sm focus:border-sky-600 focus:ring-sky-600"></div>
        <div><label for="kelas_id" class="block text-sm font-bold text-slate-700">Kelas</label><select id="kelas_id" name="kelas_id" required class="mt-1.5 min-h-12 block w-full rounded-lg border-2 border-slate-300 px-4 text-sm focus:border-sky-600 focus:ring-sky-600"><option value="">Pilih kelas</option>@foreach ($classes as $class)<option value="{{ $class->id }}" @selected(old('kelas_id', $student->kelas_id) == $class->id)>{{ $class->nama_kelas }}</option>@endforeach</select></div>
        <div><label for="no_wa_ortu" class="block text-sm font-bold text-slate-700">No WA Orang Tua</label><input id="no_wa_ortu" name="no_wa_ortu" value="{{ old('no_wa_ortu', $student->no_wa_ortu) }}" required class="mt-1.5 min-h-12 block w-full rounded-lg border-2 border-slate-300 px-4 text-sm focus:border-sky-600 focus:ring-sky-600"></div>
        <div><label for="status" class="block text-sm font-bold text-slate-700">Status</label><select id="status" name="status" required class="mt-1.5 min-h-12 block w-full rounded-lg border-2 border-slate-300 px-4 text-sm focus:border-sky-600 focus:ring-sky-600"><option value="aktif" @selected(old('status', $student->status) === 'aktif')>Aktif</option><option value="lulus" @selected(old('status', $student->status) === 'lulus')>Lulus</option><option value="pindah" @selected(old('status', $student->status) === 'pindah')>Pindah</option></select></div>
        @unless ($student->exists)<p class="rounded-lg bg-sky-50 p-3 text-sm font-semibold text-sky-800">Password otomatis dibuat sama dengan NIS.</p>@endunless
        <button type="submit" class="min-h-12 w-full rounded-lg bg-sky-700 px-5 py-3 text-sm font-extrabold text-white hover:bg-sky-800">{{ $student->exists ? 'Simpan Perubahan' : 'Tambah Siswa' }}</button>
    </form>
</div>
@endsection
