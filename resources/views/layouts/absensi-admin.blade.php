@extends('layouts.absensi')

@section('content')
<div x-data="{ sidebarOpen: false }" class="relative -mx-4 -my-6 min-h-[calc(100vh-4rem)] sm:-mx-6 sm:-my-8 lg:-mx-8 lg:-my-10">
    <div x-show="sidebarOpen" x-cloak x-transition.opacity class="fixed inset-0 z-30 bg-slate-950/40 sm:hidden" @click="sidebarOpen = false"></div>

    <div class="mx-auto flex max-w-7xl">
        <aside class="fixed inset-y-0 left-0 z-40 flex w-72 -translate-x-full flex-col border-r border-slate-200 bg-white shadow-xl transition-[width,transform] duration-200 sm:sticky sm:top-0 sm:h-[calc(100vh-4rem)] sm:w-16 sm:translate-x-0 sm:shadow-none lg:w-72" :class="sidebarOpen ? 'translate-x-0' : ''">
            <div class="flex h-16 items-center justify-between border-b border-slate-200 px-5 sm:hidden">
                <span class="text-sm font-extrabold text-slate-900">Menu Admin TU</span>
                <button type="button" @click="sidebarOpen = false" class="inline-flex h-10 w-10 items-center justify-center rounded-lg text-slate-600 hover:bg-slate-100" aria-label="Tutup menu">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" d="M6 6l12 12M18 6L6 18" /></svg>
                </button>
            </div>
            <div class="border-b border-slate-200 px-5 py-5 sm:px-2 lg:px-5">
                <p class="text-center text-xs font-bold uppercase tracking-[0.14em] text-sky-700 lg:text-left">A<span class="hidden lg:inline">dministrasi</span></p>
                <p class="mt-1 hidden text-base font-extrabold text-slate-900 lg:block">Admin TU</p>
            </div>
            <nav class="flex-1 space-y-1 p-3 sm:p-2 lg:p-3" aria-label="Navigasi Admin TU">
                @php
                    $adminMenu = [
                        ['label' => 'Dashboard', 'route' => 'absensi.admin', 'pattern' => 'absensi.admin', 'icon' => 'dashboard'],
                        ['label' => 'Import Data Siswa', 'route' => 'absensi.admin.import-siswa', 'pattern' => 'absensi.admin.import-siswa*', 'icon' => 'import'],
                        ['label' => 'Kelola Siswa', 'route' => 'absensi.admin.siswa.index', 'pattern' => 'absensi.admin.siswa*', 'icon' => 'students'],
                        ['label' => 'Kelola Kelas', 'route' => 'absensi.admin.kelas.index', 'pattern' => 'absensi.admin.kelas*', 'icon' => 'classes'],
                        ['label' => 'Jadwal Piket', 'route' => 'absensi.admin.jadwal-piket.index', 'pattern' => 'absensi.admin.jadwal-piket*', 'icon' => 'schedule'],
                        ['label' => 'QR Gerbang', 'route' => 'absensi.admin.qr-gerbang.index', 'pattern' => 'absensi.admin.qr-gerbang*', 'icon' => 'gate'],
                        ['label' => 'Export Laporan', 'route' => 'absensi.admin.laporan', 'pattern' => 'absensi.admin.laporan*', 'icon' => 'report'],
                        ['label' => 'Log Notifikasi WA', 'route' => 'absensi.admin.notifikasi-wa', 'pattern' => 'absensi.admin.notifikasi-wa*', 'icon' => 'notification'],
                    ];
                @endphp
                @foreach ($adminMenu as $item)
                    <a href="{{ route($item['route']) }}" title="{{ $item['label'] }}" aria-label="{{ $item['label'] }}" @click="sidebarOpen = false" class="flex min-h-11 items-center justify-center rounded-lg px-3 text-sm font-bold transition sm:px-0 lg:justify-start lg:px-3 {{ request()->routeIs($item['pattern']) ? 'bg-sky-100 text-sky-900' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                        @if ($item['icon'] === 'dashboard')
                            <svg class="h-5 w-5 shrink-0 lg:mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="3.5" y="3.5" width="7" height="7" rx="1" /><rect x="13.5" y="3.5" width="7" height="7" rx="1" /><rect x="3.5" y="13.5" width="7" height="7" rx="1" /><rect x="13.5" y="13.5" width="7" height="7" rx="1" /></svg>
                        @elseif ($item['icon'] === 'import')
                            <svg class="h-5 w-5 shrink-0 lg:mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v11m0 0 4-4m-4 4-4-4M5 17v1.5A2.5 2.5 0 0 0 7.5 21h9a2.5 2.5 0 0 0 2.5-2.5V17" /></svg>
                        @elseif ($item['icon'] === 'students')
                            <svg class="h-5 w-5 shrink-0 lg:mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="9" cy="8" r="3" /><path stroke-linecap="round" d="M3.5 19a5.5 5.5 0 0 1 11 0M16 11a3 3 0 1 0 0-6M16.5 14a4.5 4.5 0 0 1 4 5" /></svg>
                        @elseif ($item['icon'] === 'classes')
                            <svg class="h-5 w-5 shrink-0 lg:mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v15H6.5A2.5 2.5 0 0 0 4 20.5v-15ZM4 5.5v15M8 7h8M8 11h8" /></svg>
                        @elseif ($item['icon'] === 'schedule')
                            <svg class="h-5 w-5 shrink-0 lg:mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="12" cy="12" r="8.5" /><path stroke-linecap="round" d="M12 7v5l3 2" /></svg>
                        @elseif ($item['icon'] === 'report')
                            <svg class="h-5 w-5 shrink-0 lg:mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 20V4h14v16M8 8h8M8 12h8M8 16h5" /></svg>
                        @elseif ($item['icon'] === 'notification')
                            <svg class="h-5 w-5 shrink-0 lg:mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9M10 21h4" /></svg>
                        @else
                            <svg class="h-5 w-5 shrink-0 lg:mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4 9.5 12 4l8 5.5v8A1.5 1.5 0 0 1 18.5 19h-13A1.5 1.5 0 0 1 4 17.5v-8Z" /><path stroke-linecap="round" d="M9 19v-5h6v5" /></svg>
                        @endif
                        <span class="hidden lg:inline">{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>
        </aside>

        <div class="min-w-0 flex-1">
            <div class="border-b border-slate-200 bg-white px-4 py-3 sm:hidden">
                <button type="button" @click="sidebarOpen = true" class="inline-flex min-h-11 items-center gap-2 rounded-lg border-2 border-slate-300 bg-white px-4 text-sm font-extrabold text-slate-700 hover:bg-slate-50" aria-label="Buka menu admin">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16" /></svg>
                    Menu Admin
                </button>
            </div>
            <div class="p-4 sm:p-6 lg:p-8">
                @yield('admin-content')
            </div>
        </div>
    </div>
</div>
@endsection
