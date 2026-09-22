<div wire:poll.5s class="space-y-5">
    <div class="flex flex-col gap-1 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.14em] text-sky-700">Gerbang Sekolah</p>
            <h1 class="mt-1 text-2xl font-extrabold text-slate-900">Halo, {{ $guru?->nama ?? 'Guru' }}</h1>
        </div>
        <p class="text-sm font-semibold text-slate-600">{{ now()->translatedFormat('l, d F Y') }} &bull; {{ now()->format('H:i') }}</p>
    </div>

    <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
        <div class="rounded-xl border-2 border-emerald-200 bg-emerald-50 p-4">
            <p class="text-sm font-bold text-emerald-800">Hadir</p>
            <p class="mt-1 text-4xl font-black text-emerald-900">{{ $stats['hadir'] }}</p>
            <p class="mt-1 text-xs font-semibold text-emerald-700">sudah absen masuk</p>
        </div>
        <div class="rounded-xl border-2 border-amber-200 bg-amber-50 p-4">
            <p class="text-sm font-bold text-amber-800">Terlambat</p>
            <p class="mt-1 text-4xl font-black text-amber-900">{{ $stats['terlambat'] }}</p>
            <p class="mt-1 text-xs font-semibold text-amber-700">perlu perhatian</p>
        </div>
        <div class="rounded-xl border-2 border-slate-200 bg-white p-4">
            <p class="text-sm font-bold text-slate-700">Belum Absen</p>
            <p class="mt-1 text-4xl font-black text-slate-900">{{ max(0, $stats['belum']) }}</p>
            <p class="mt-1 text-xs font-semibold text-slate-500">siswa aktif</p>
        </div>
    </div>

    <section class="rounded-xl border-2 border-slate-200 bg-white p-4 shadow-sm sm:p-5">
        <div class="flex items-center justify-between gap-3">
            <div>
                <h2 class="text-lg font-extrabold text-slate-900">Absensi Terbaru</h2>
                <p class="mt-1 text-xs text-slate-500">Diperbarui otomatis setiap 5 detik.</p>
            </div>
            <span class="rounded-full bg-sky-100 px-3 py-1 text-xs font-bold text-sky-800">Realtime</span>
        </div>

        <div class="mt-4 space-y-2">
            @forelse ($recentLogs as $log)
                <div class="flex items-center justify-between gap-3 rounded-lg border border-slate-200 p-3">
                    <div class="min-w-0">
                        <p class="truncate text-sm font-extrabold text-slate-900">{{ $log->siswa?->nama }}</p>
                        <p class="mt-0.5 text-xs font-medium text-slate-500">{{ $log->siswa?->kelas?->nama_kelas ?? '-' }} &bull; {{ $log->jam_masuk?->format('H:i') }}</p>
                    </div>
                    <span class="shrink-0 rounded-full px-2.5 py-1 text-xs font-extrabold {{ $log->status_masuk === 'hadir' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                        {{ ucfirst($log->status_masuk) }}
                    </span>
                </div>
            @empty
                <p class="rounded-lg bg-slate-50 p-5 text-center text-sm font-medium text-slate-500">Belum ada siswa yang absen hari ini.</p>
            @endforelse
        </div>
    </section>

    <section class="rounded-xl border-2 border-slate-200 bg-white p-4 shadow-sm sm:p-5">
        <div>
            <h2 class="text-lg font-extrabold text-slate-900">Input Manual</h2>
            <p class="mt-1 text-sm text-slate-600">Gunakan jika HP siswa bermasalah atau tertinggal.</p>
        </div>

        @if ($feedback)
            <div class="mt-4 rounded-lg border p-3 text-sm font-bold {{ $feedbackType === 'success' ? 'border-emerald-200 bg-emerald-50 text-emerald-800' : 'border-red-200 bg-red-50 text-red-800' }}" role="alert">
                {{ $feedback }}
            </div>
        @endif

        <form wire:submit="saveManualAttendance" class="mt-4 space-y-4">
            <div class="relative">
                <label for="student-search" class="block text-sm font-bold text-slate-700">Cari siswa</label>
                <input
                    id="student-search"
                    type="search"
                    wire:model.live.debounce.250ms="search"
                    placeholder="Ketik nama atau NIS"
                    autocomplete="off"
                    class="mt-1.5 min-h-14 block w-full rounded-xl border-2 border-slate-300 bg-white px-4 text-base font-semibold text-slate-900 placeholder:text-slate-400 focus:border-sky-600 focus:ring-sky-600"
                >
                @if ($search && $selectedSiswaId === null && $students->isNotEmpty())
                    <div class="absolute z-10 mt-1 max-h-64 w-full overflow-y-auto rounded-xl border-2 border-slate-200 bg-white shadow-lg">
                        @foreach ($students as $student)
                            <button type="button" wire:click="selectStudent({{ $student->id }})" class="block min-h-14 w-full border-b border-slate-100 px-4 py-3 text-left last:border-b-0 hover:bg-sky-50">
                                <span class="block text-sm font-extrabold text-slate-900">{{ $student->nama }}</span>
                                <span class="mt-0.5 block text-xs font-medium text-slate-500">NIS {{ $student->nis }} &bull; {{ $student->kelas?->nama_kelas ?? '-' }}</span>
                            </button>
                        @endforeach
                    </div>
                @elseif ($search && $selectedSiswaId === null && $students->isEmpty())
                    <p class="mt-2 text-sm font-semibold text-slate-500">Siswa tidak ditemukan.</p>
                @endif
                @error('selectedSiswaId') <p class="mt-1 text-sm font-bold text-red-700">{{ $message }}</p> @enderror
            </div>

            <div>
                <p class="text-sm font-bold text-slate-700">Status</p>
                <div class="mt-2 grid grid-cols-2 gap-3">
                    <label class="flex min-h-12 cursor-pointer items-center justify-center rounded-xl border-2 px-3 text-sm font-extrabold {{ $status === 'hadir' ? 'border-emerald-600 bg-emerald-50 text-emerald-800' : 'border-slate-300 text-slate-600' }}">
                        <input type="radio" wire:model="status" value="hadir" class="sr-only">
                        Hadir
                    </label>
                    <label class="flex min-h-12 cursor-pointer items-center justify-center rounded-xl border-2 px-3 text-sm font-extrabold {{ $status === 'terlambat' ? 'border-amber-600 bg-amber-50 text-amber-800' : 'border-slate-300 text-slate-600' }}">
                        <input type="radio" wire:model="status" value="terlambat" class="sr-only">
                        Terlambat
                    </label>
                </div>
            </div>

            <button type="submit" wire:loading.attr="disabled" wire:target="saveManualAttendance" class="min-h-14 w-full rounded-xl bg-sky-700 px-5 py-4 text-base font-extrabold text-white shadow-sm transition hover:bg-sky-800 disabled:cursor-not-allowed disabled:opacity-60">
                <span wire:loading.remove wire:target="saveManualAttendance">Simpan Absensi Manual</span>
                <span wire:loading wire:target="saveManualAttendance">Menyimpan...</span>
            </button>
        </form>
    </section>
</div>
