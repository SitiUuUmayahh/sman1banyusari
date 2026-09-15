<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} | @yield('title', 'Absensi')</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-[#f4f7fd] font-sans text-slate-800">
        @php
            $absensiUser = Auth::guard('siswa')->user() ?? Auth::guard('guru')->user();
        @endphp

        <div class="min-h-screen">
            @unless (request()->routeIs('absensi.login'))
                <header class="border-b border-slate-200 bg-white">
                    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
                        <a href="{{ route('absensi.login') }}" class="flex min-w-0 items-center gap-3" aria-label="Sistem Absensi SMAN 1 Banyusari">
                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-slate-800 text-sm font-extrabold text-white">S</span>
                            <span class="truncate text-sm font-bold text-slate-800">SMAN 1 Banyusari <span class="font-normal text-slate-500">/ Absensi</span></span>
                        </a>

                        @if ($absensiUser)
                            <form method="POST" action="{{ route('absensi.logout') }}">
                                @csrf
                                <button type="submit" class="rounded-md border border-slate-300 bg-white px-3 py-2 text-xs font-semibold text-slate-700 transition hover:border-slate-400 hover:bg-slate-50">Logout</button>
                            </form>
                        @endif
                    </div>
                </header>
            @endunless

            <main class="mx-auto w-full max-w-7xl px-4 py-6 sm:px-6 sm:py-8 lg:px-8 lg:py-10">
                @yield('content')
            </main>
        </div>
    </body>
</html>
