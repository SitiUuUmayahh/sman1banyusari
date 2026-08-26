@extends('layouts.app')

@section('title', 'Prestasi')

@section('content')
<div class="space-y-6 sm:space-y-8">
    <div class="text-center sm:text-left">
        <h1 class="text-3xl sm:text-4xl font-bold text-slate-900">Prestasi</h1>
        <p class="mt-2 text-slate-600">Pencapaian siswa dan sekolah</p>
    </div>

    <!-- Filter Dropdown -->
    <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center">
        <label for="filter" class="text-sm font-semibold text-slate-700">Filter Tingkat:</label>
        <select id="filter" onchange="window.location.href = new URL(window.location).searchParams.set('tingkat', this.value) || '{{ route('achievement.index') }}?tingkat=' + this.value, window.location).href" class="rounded-lg border border-slate-300 px-4 py-2 pr-10 text-sm text-slate-700 min-w-max">
            <option value="semua" {{ $filter === 'semua' ? 'selected' : '' }}>Semua</option>
            @foreach($tingkats as $tingkat)
                <option value="{{ $tingkat }}" {{ $filter === $tingkat ? 'selected' : '' }}>
                    {{ ucfirst($tingkat) }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Achievements Grid -->
    @if($achievements->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            @foreach($achievements as $achievement)
                <div class="rounded-2xl border border-slate-200 bg-white p-5 sm:p-6 shadow-sm hover:shadow-lg transition">
                    @if($achievement->gambar)
                        <div class="aspect-square overflow-hidden rounded-lg bg-slate-200 mb-4">
                            <img src="{{ $achievement->gambar ? (str_starts_with($achievement->gambar, 'http') ? $achievement->gambar : asset('storage/' . $achievement->gambar)) : asset('images/placeholder.png') }}" alt="{{ $achievement->judul }}" loading="lazy" class="h-full w-full object-cover">
                        </div>
                    @else
                        <div class="aspect-square rounded-lg bg-gradient-to-br from-amber-100 to-orange-100 mb-4 flex items-center justify-center">
                            <svg class="h-16 w-16 text-orange-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                        </div>
                    @endif

                    <div class="space-y-3">
                        <div>
                            <div class="inline-block rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700 capitalize">
                                {{ $achievement->tingkat }}
                            </div>
                            <h3 class="mt-3 text-lg sm:text-xl font-bold text-slate-900 line-clamp-2">
                                {{ $achievement->judul }}
                            </h3>
                        </div>

                        @if($achievement->nama_siswa)
                            <p class="text-sm text-slate-600">
                                <strong>Siswa:</strong> {{ $achievement->nama_siswa }}
                            </p>
                        @endif

                        <p class="text-sm font-medium text-slate-500">
                            Tahun {{ $achievement->tahun }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center pt-6 sm:pt-8">
            {{ $achievements->appends(request()->query())->links() }}
        </div>
    @else
        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6 sm:p-8 text-center">
            <p class="text-slate-600">Belum ada prestasi untuk filter ini</p>
        </div>
    @endif
</div>
@endsection
