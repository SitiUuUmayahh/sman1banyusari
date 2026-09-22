@extends('layouts.absensi')

@section('title', 'Login Absensi')

@section('content')
<div class="mx-auto flex min-h-[calc(100vh-3rem)] max-w-sm flex-col justify-center">
    <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-md sm:p-6">
        <div class="mb-6 text-center">
            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-xl bg-sky-700 text-white shadow-md" aria-hidden="true">
                <svg class="h-8 w-8" viewBox="0 0 32 32" fill="none">
                    <rect x="5" y="5" width="8" height="8" rx="2" fill="currentColor" />
                    <rect x="19" y="5" width="8" height="8" rx="2" fill="currentColor" />
                    <rect x="5" y="19" width="8" height="8" rx="2" fill="currentColor" />
                    <circle cx="23" cy="23" r="5" fill="white" />
                    <path d="M20.5 23l1.7 1.7 3.3-3.8" stroke="#0369a1" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <p class="mt-3 text-base font-bold text-slate-800">SISABA</p>
            <p class="mt-1 text-[11px] font-medium text-slate-500">SMAN 1 Banyusari</p>
            <p class="mt-1 text-[10px] text-slate-400">sistem absensi SMAN 1 Banyusari</p>
        </div>

        <div class="mb-5">
            <h1 class="text-xl font-extrabold text-slate-900">Masuk</h1>
            <p class="mt-1 text-xs text-slate-500">Gunakan NIS untuk siswa atau username untuk guru.</p>
        </div>

        @if ($errors->any())
            <div class="mb-4 rounded-md border border-red-200 bg-red-50 p-3 text-xs text-red-700">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('absensi.login.store') }}" class="space-y-4">
            @csrf
            <div>
                <label for="username" class="block text-[11px] font-bold text-slate-600">NIS / Username</label>
                <div class="relative mt-1.5">
                    <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-slate-400" aria-hidden="true">&#128100;</span>
                    <input id="username" name="username" type="text" value="{{ old('username') }}" required autofocus autocomplete="username" placeholder="Masukkan NIS atau username" class="block w-full rounded-md border-slate-200 bg-slate-50 py-2.5 pl-9 pr-3 text-xs text-slate-700 placeholder:text-slate-400 focus:border-sky-600 focus:ring-sky-600">
                </div>
            </div>
            <div>
                <label for="password" class="block text-[11px] font-bold text-slate-600">Password</label>
                <div class="relative mt-1.5">
                    <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-slate-400" aria-hidden="true">&#128274;</span>
                    <input id="password" name="password" type="password" required autocomplete="current-password" placeholder="Masukkan password" class="block w-full rounded-md border-slate-200 bg-slate-50 py-2.5 pl-9 pr-3 text-xs text-slate-700 placeholder:text-slate-400 focus:border-sky-600 focus:ring-sky-600">
                </div>
            </div>
            <div class="flex items-center justify-between text-[10px]">
                <label class="inline-flex items-center gap-1.5 text-slate-500">
                    <input type="checkbox" name="remember" class="h-3 w-3 rounded border-slate-300 text-sky-700 focus:ring-sky-600">
                    Ingat saya
                </label>
            </div>
            <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-md bg-sky-700 px-4 py-2.5 text-xs font-bold text-white shadow-sm transition hover:bg-sky-800">Masuk <span aria-hidden="true">&rarr;</span></button>
        </form>
    </div>
    <p class="mt-5 text-center text-[10px] font-semibold text-slate-500">&copy; {{ date('Y') }} SMAN 1 Banyusari</p>
</div>
@endsection
