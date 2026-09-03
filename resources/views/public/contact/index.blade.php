@extends('layouts.app')

@section('title', 'Kontak')

@section('content')
<div class="space-y-6 sm:space-y-8">
    <div class="text-center sm:text-left">
        <h1 class="text-3xl sm:text-4xl font-bold text-slate-900">Kontak Kami</h1>
        <p class="mt-2 text-slate-600">Hubungi kami untuk informasi lebih lanjut</p>
    </div>

    <!-- Alert Messages -->
    @if ($errors->any())
        <div class="rounded-lg border border-red-200 bg-red-50 p-4">
            <p class="text-sm font-semibold text-red-800">Ada kesalahan:</p>
            <ul class="mt-2 list-inside space-y-1 text-sm text-red-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="rounded-lg border border-green-200 bg-green-50 p-4">
            <p class="text-sm font-semibold text-green-800">{{ session('success') }}</p>
        </div>
    @endif

    <div class="grid max-w-6xl grid-cols-1 gap-6 sm:gap-8 lg:grid-cols-2">
        <!-- Contact Info -->
        <div class="space-y-6">
            @if($settings->alamat_sekolah)
            <div class="rounded-2xl border border-slate-200 bg-white p-5 sm:p-6 shadow-sm">
                <div class="flex gap-4">
                    <div class="flex-shrink-0">
                        <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-blue-100">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-slate-900">Alamat</h3>
                        <p class="mt-1 text-slate-600">{{ $settings->alamat_sekolah }}</p>
                    </div>
                </div>
            </div>
            @endif

            @if($settings->email_sekolah)
            <div class="rounded-2xl border border-slate-200 bg-white p-5 sm:p-6 shadow-sm">
                <div class="flex gap-4">
                    <div class="flex-shrink-0">
                        <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-blue-100">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-slate-900">Email</h3>
                        <p class="mt-1 text-slate-600">
                            <a href="mailto:{{ $settings->email_sekolah }}" class="text-blue-600 hover:text-blue-500">
                                {{ $settings->email_sekolah }}
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            @endif

            @if($settings->telepon_sekolah)
            <div class="rounded-2xl border border-slate-200 bg-white p-5 sm:p-6 shadow-sm">
                <div class="flex gap-4">
                    <div class="flex-shrink-0">
                        <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-blue-100">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-slate-900">Telepon</h3>
                        <p class="mt-1 text-slate-600">
                            <a href="tel:{{ str_replace([' ', '-', '(', ')'], '', $settings->telepon_sekolah) }}" class="text-blue-600 hover:text-blue-500">
                                {{ $settings->telepon_sekolah }}
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            @endif

            @php
                $socialLinks = [
                    'instagram' => $settings->instagram_url,
                    'facebook' => $settings->facebook_url,
                    'youtube' => $settings->youtube_url,
                    'tiktok' => $settings->tiktok_url,
                ];
            @endphp

            @if(collect($socialLinks)->filter()->isNotEmpty())
            <div class="rounded-2xl border border-slate-200 bg-white p-5 sm:p-6 shadow-sm">
                <h3 class="font-semibold text-slate-900">Media Sosial</h3>
                <div class="mt-4 flex flex-wrap gap-3">
                    @if($settings->instagram_url)
                        <a href="{{ $settings->instagram_url }}" target="_blank" rel="noopener" aria-label="Instagram" class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-br from-purple-500 via-pink-500 to-orange-400 text-white shadow-sm hover:opacity-90">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M7 2h10a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5V7a5 5 0 0 1 5-5zm0 2a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3H7zm5 3.5A4.5 4.5 0 1 1 7.5 12 4.5 4.5 0 0 1 12 7.5zm0 2A2.5 2.5 0 1 0 14.5 12 2.5 2.5 0 0 0 12 9.5zm5-3.25a1.25 1.25 0 1 1-1.25 1.25A1.25 1.25 0 0 1 17 6.25z"/></svg>
                        </a>
                    @endif

                    @if($settings->facebook_url)
                        <a href="{{ $settings->facebook_url }}" target="_blank" rel="noopener" aria-label="Facebook" class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-blue-600 text-white shadow-sm hover:opacity-90">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M13.5 22v-8h2.5l.5-3h-3V7.5c0-.9.4-1.5 1.5-1.5H16V3.2c-.5-.1-1.4-.2-2.6-.2-2.4 0-4.1 1.5-4.1 4.2V11H7v3h2.3v8h4.2z"/></svg>
                        </a>
                    @endif

                    @if($settings->youtube_url)
                        <a href="{{ $settings->youtube_url }}" target="_blank" rel="noopener" aria-label="YouTube" class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-red-600 text-white shadow-sm hover:opacity-90">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.5 12c0-1.4-.1-2.8-.4-4.1-.5-2-2.1-3.6-4.1-4.1C17.8 3.5 15.4 3 12 3s-5.8.5-7 .8c-2 .5-3.6 2.1-4.1 4.1C.5 9.2.4 10.6.4 12c0 1.4.1 2.8.4 4.1.5 2 2.1 3.6 4.1 4.1 1.2.3 3.6.8 7 .8s5.8-.5 7-.8c2-.5 3.6-2.1 4.1-4.1.3-1.3.4-2.7.4-4.1zm-13.5 4.6V7.4L17 12l-7 4.6z"/></svg>
                        </a>
                    @endif

                    @if($settings->tiktok_url)
                        <a href="{{ $settings->tiktok_url }}" target="_blank" rel="noopener" aria-label="TikTok" class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-slate-900 text-white shadow-sm hover:opacity-90">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M16.7 3c.2 1.6 1.2 2.9 2.9 3.3v2.4c-1.1 0-2.1-.3-3.1-.9v6.2a4.7 4.7 0 1 1-4.7-4.7c.2 0 .4 0 .7.1v2.5a2.2 2.2 0 1 0 1.5 2.1V3h3.7z"/></svg>
                        </a>
                    @endif
                </div>
            </div>
            @endif
        </div>

        <!-- Contact Form -->
        <div class="rounded-2xl border border-slate-200 bg-white p-5 sm:p-6 shadow-sm">
            <h3 class="text-xl font-bold text-slate-900 mb-6">Kirim Pesan</h3>

            <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="nama" class="block text-sm font-semibold text-slate-700 mb-2">
                        Nama
                    </label>
                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        value="{{ old('nama') }}"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2 text-slate-900 placeholder-slate-500 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                        placeholder="Nama lengkap Anda"
                        required
                    >
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">
                        Email
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2 text-slate-900 placeholder-slate-500 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                        placeholder="email@example.com"
                        required
                    >
                </div>

                <div>
                    <label for="subjek" class="block text-sm font-semibold text-slate-700 mb-2">
                        Subjek
                    </label>
                    <input
                        type="text"
                        id="subjek"
                        name="subjek"
                        value="{{ old('subjek') }}"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2 text-slate-900 placeholder-slate-500 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                        placeholder="Subjek pesan"
                        required
                    >
                </div>

                <div>
                    <label for="pesan" class="block text-sm font-semibold text-slate-700 mb-2">
                        Pesan
                    </label>
                    <textarea
                        id="pesan"
                        name="pesan"
                        rows="5"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2 text-slate-900 placeholder-slate-500 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                        placeholder="Tulis pesan Anda di sini..."
                        required
                    >{{ old('pesan') }}</textarea>
                </div>

                <button
                    type="submit"
                    class="w-full rounded-lg bg-blue-600 px-4 py-3 text-center font-semibold text-white shadow-md transition hover:bg-blue-500 active:scale-95"
                >
                    Kirim Pesan
                </button>
            </form>
        </div>
    </div>

    <!-- Maps Placeholder -->
    <div class="max-w-6xl overflow-hidden rounded-2xl border border-slate-200 bg-slate-100">
        @if($settings->google_maps_embed_url)
            {!! $settings->google_maps_embed_url !!}
        @else
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.7865033036247!2d107.00394!3d-6.267!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698d5d5d5d5d5d%3A0x5d5d5d5d5d5d5d!2sSMAN%201%20Banyusari!5e0!3m2!1sid!2sid!4v1234567890"
                width="100%"
                height="400"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
        @endif
    </div>
</div>
@endsection
