<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} | @yield('title', 'Dashboard')</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-100 font-sans text-slate-800">
        <div class="min-h-screen">
            @include('layouts.navbar')

            @isset($header)
                <header class="border-b border-slate-200 bg-white/80 backdrop-blur-sm">
                    <div class="container-shell py-5 sm:py-6 lg:py-7">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="container-shell py-6 sm:py-8 lg:py-10">
                @if (isset($slot))
                    {{ $slot }}
                @elseif(isset($content))
                    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6 lg:p-8">
                        <p class="text-base font-medium text-slate-700">{{ $content }}</p>
                    </div>
                @else
                    @yield('content')
                @endif
            </main>
        </div>
    </body>
</html>
