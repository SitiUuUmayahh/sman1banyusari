@extends('layouts.app')

@section('title', 'Profil Sekolah')

@section('content')
<div class="space-y-6 sm:space-y-8">
    <div class="text-center sm:text-left">
        <h1 class="text-3xl sm:text-4xl font-bold text-slate-900">Profil Sekolah</h1>
        <p class="mt-2 text-slate-600">Kenali lebih dekat SMAN 1 Banyusari</p>
    </div>

    <!-- Tabs / Accordion for Mobile -->
    <div x-data="{ activeTab: 'sambutan-kepsek' }" class="space-y-4">
        <!-- Mobile Accordion -->
        <div class="space-y-3 md:hidden">
            @foreach(['sambutan-kepsek' => 'Sambutan Kepala Sekolah', 'sejarah' => 'Sejarah', 'visi-misi' => 'Visi & Misi', 'fasilitas' => 'Fasilitas'] as $slug => $label)
                <button
                    @click="activeTab = '{{ $slug }}'"
                    class="w-full rounded-lg border border-slate-200 bg-white px-4 py-3 text-left font-semibold text-slate-900 transition hover:bg-slate-50"
                    :class="activeTab === '{{ $slug }}' ? 'border-blue-600 bg-blue-50' : ''"
                >
                    {{ $label }}
                </button>

                @if($sections[$slug])
                    <div
                        x-show="activeTab === '{{ $slug }}'"
                        x-transition
                        class="rounded-lg border border-slate-200 bg-white p-4 sm:p-5"
                    >
                        <div class="prose prose-sm max-w-none text-slate-700">
                            {!! $sections[$slug]->konten !!}
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Desktop Tabs -->
        <div class="hidden md:block">
            <div class="flex gap-2 border-b border-slate-200">
                @foreach(['sambutan-kepsek' => 'Sambutan Kepala Sekolah', 'sejarah' => 'Sejarah', 'visi-misi' => 'Visi & Misi', 'fasilitas' => 'Fasilitas'] as $slug => $label)
                    <button
                        @click="activeTab = '{{ $slug }}'"
                        class="px-4 py-3 font-semibold text-slate-700 border-b-2 border-transparent transition hover:text-slate-900"
                        :class="activeTab === '{{ $slug }}' ? 'border-blue-600 text-blue-600' : ''"
                    >
                        {{ $label }}
                    </button>
                @endforeach
            </div>

            <div class="mt-6 space-y-4">
                @foreach(['sambutan-kepsek' => 'Sambutan Kepala Sekolah', 'sejarah' => 'Sejarah', 'visi-misi' => 'Visi & Misi', 'fasilitas' => 'Fasilitas'] as $slug => $label)
                    @if($sections[$slug])
                        <div
                            x-show="activeTab === '{{ $slug }}'"
                            x-transition
                            class="rounded-lg bg-white p-6"
                        >
                            <h3 class="text-xl font-bold text-slate-900 mb-4">{{ $label }}</h3>
                            <div class="prose prose-base max-w-none text-slate-700">
                                {!! $sections[$slug]->konten !!}
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
