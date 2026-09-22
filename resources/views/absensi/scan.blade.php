@extends('layouts.absensi')

@section('title', 'Scan Absensi')

@section('content')
<div class="mx-auto max-w-lg">
    <div class="mb-5">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.14em] text-sky-700">Absensi Siswa</p>
            <h1 class="mt-1 text-2xl font-extrabold text-slate-900">Halo, {{ $siswa->nama }}</h1>
            <p class="mt-1 text-sm font-medium text-slate-600">
                Kelas {{ $siswa->kelas?->nama_kelas ?? '-' }}
                <span class="mx-1 text-slate-300">&bull;</span>
                Shift {{ ucfirst($siswa->kelas?->shift ?? '-') }}
            </p>
        </div>
    </div>

    <section class="rounded-2xl border-2 border-slate-200 bg-white p-5 shadow-sm sm:p-7" aria-live="polite">
        <div id="scan-loading" class="flex flex-col items-center py-8 text-center">
            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-sky-100 text-sky-700">
                <svg class="h-8 w-8 animate-pulse" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0-13v4l2.5 2.5" />
                </svg>
            </div>
            <h2 class="mt-5 text-xl font-extrabold text-slate-900">Mencari lokasi Anda...</h2>
            <p class="mt-2 max-w-sm text-base leading-6 text-slate-600">Izinkan akses lokasi agar kami dapat memastikan Anda berada di gerbang sekolah.</p>
        </div>

        <div id="scan-error" class="hidden py-5 text-center">
            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-red-100 text-3xl text-red-700" aria-hidden="true">!</div>
            <h2 id="scan-error-title" class="mt-5 text-xl font-extrabold text-slate-900">Lokasi belum tersedia</h2>
            <p id="scan-error-message" class="mt-2 text-base leading-6 text-slate-600"></p>
            <button id="retry-button" type="button" class="mt-6 min-h-12 w-full rounded-xl bg-sky-700 px-5 py-3 text-base font-extrabold text-white shadow-sm transition hover:bg-sky-800 disabled:cursor-not-allowed disabled:opacity-60">Coba Lagi</button>
        </div>

        <div id="scan-success" class="hidden py-5 text-center">
            <div id="success-icon" class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-emerald-100 text-5xl font-black text-emerald-700" aria-hidden="true">&#10003;</div>
            <h2 id="success-title" class="mt-5 text-2xl font-extrabold text-slate-900"></h2>
            <p id="success-message" class="mt-2 text-base leading-6 text-slate-600"></p>
            <p class="mt-5 text-sm font-bold uppercase tracking-wider text-slate-500">Waktu tercatat</p>
            <p id="success-time" class="mt-1 text-4xl font-black text-slate-900"></p>
            <button id="scan-again-button" type="button" class="mt-6 min-h-12 w-full rounded-xl border-2 border-sky-700 bg-white px-5 py-3 text-base font-extrabold text-sky-700 transition hover:bg-sky-50">Scan Lagi</button>
        </div>

        <div id="scan-ready" class="hidden py-5 text-center">
            <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-sky-100 text-sky-700" aria-hidden="true">
                <svg class="h-10 w-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0-13v4l2.5 2.5" />
                </svg>
            </div>
            <h2 class="mt-5 text-xl font-extrabold text-slate-900">Siap melakukan absensi</h2>
            <p class="mt-2 text-base leading-6 text-slate-600">Tekan tombol di bawah untuk mencoba lokasi Anda lagi.</p>
            <button id="ready-button" type="button" class="mt-6 min-h-14 w-full rounded-xl bg-sky-700 px-5 py-4 text-lg font-extrabold text-white shadow-sm transition hover:bg-sky-800 disabled:cursor-not-allowed disabled:opacity-60">Aktifkan Lokasi &amp; Scan</button>
        </div>
    </section>

    <p class="mt-5 text-center text-xs font-medium leading-5 text-slate-500">Lokasi hanya digunakan untuk validasi gerbang sekolah. Saat dipasang di domain produksi, fitur ini wajib menggunakan HTTPS/SSL.</p>
</div>

<script>
    (() => {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        const loading = document.getElementById('scan-loading');
        const error = document.getElementById('scan-error');
        const success = document.getElementById('scan-success');
        const ready = document.getElementById('scan-ready');
        const errorTitle = document.getElementById('scan-error-title');
        const errorMessage = document.getElementById('scan-error-message');
        const retryButton = document.getElementById('retry-button');
        const readyButton = document.getElementById('ready-button');
        const scanAgainButton = document.getElementById('scan-again-button');
        const successIcon = document.getElementById('success-icon');
        const successTitle = document.getElementById('success-title');
        const successMessage = document.getElementById('success-message');
        const successTime = document.getElementById('success-time');
        let processing = false;

        function showOnly(panel) {
            [loading, error, success, ready].forEach((element) => element.classList.add('hidden'));
            panel.classList.remove('hidden');
        }

        function showError(title, message) {
            errorTitle.textContent = title;
            errorMessage.textContent = message;
            showOnly(error);
        }

        function setButtonsDisabled(disabled) {
            retryButton.disabled = disabled;
            readyButton.disabled = disabled;
            scanAgainButton.disabled = disabled;
        }

        function geolocationMessage(code) {
            if (code === 1) return 'Izin lokasi ditolak. Izinkan lokasi di pengaturan browser, lalu tekan Coba Lagi.';
            if (code === 2) return 'Lokasi tidak dapat ditemukan. Pastikan GPS aktif, lalu tekan Coba Lagi.';
            if (code === 3) return 'Waktu menunggu GPS habis. Coba lagi di area dengan sinyal yang lebih baik.';
            return 'Lokasi tidak dapat diakses. Pastikan browser mengizinkan geolocation, lalu coba lagi.';
        }

        function scan() {
            if (processing) return;
            processing = true;
            setButtonsDisabled(true);
            showOnly(loading);

            if (!navigator.geolocation) {
                processing = false;
                setButtonsDisabled(false);
                showError('GPS tidak didukung', 'Browser ini tidak mendukung geolocation. Gunakan browser modern dan tekan Coba Lagi.');
                return;
            }

            navigator.geolocation.getCurrentPosition(async (position) => {
                try {
                    const response = await fetch('{{ route('absensi.scan.process') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: JSON.stringify({
                            latitude: position.coords.latitude,
                            longitude: position.coords.longitude,
                        }),
                    });
                    const data = await response.json();

                    if (!response.ok) {
                        throw new Error(data.message || 'Absensi tidak dapat diproses.');
                    }

                    if (data.status === 'selesai') {
                        showError('Anda sudah absen hari ini', 'Absensi masuk dan pulang Anda sudah tercatat.');
                        return;
                    }

                    const isLate = data.status === 'terlambat';
                    successIcon.className = `mx-auto flex h-20 w-20 items-center justify-center rounded-full ${isLate ? 'bg-amber-100 text-amber-700' : 'bg-emerald-100 text-emerald-700'} text-5xl font-black`;
                    successIcon.textContent = isLate ? '!' : '✓';
                    successTitle.textContent = data.action === 'pulang' ? 'Absen pulang berhasil' : (isLate ? 'Absen terlambat berhasil' : 'Absen hadir berhasil');
                    successMessage.textContent = data.action === 'pulang' ? 'Waktu pulang Anda sudah tercatat.' : 'Waktu masuk Anda sudah tercatat.';
                    successTime.textContent = data.time;
                    showOnly(success);
                } catch (scanError) {
                    showError('Absensi gagal', scanError.message);
                } finally {
                    processing = false;
                    setButtonsDisabled(false);
                }
            }, (geolocationError) => {
                processing = false;
                setButtonsDisabled(false);
                showError('Lokasi belum tersedia', geolocationMessage(geolocationError.code));
            }, {
                enableHighAccuracy: true,
                timeout: 15000,
                maximumAge: 0,
            });
        }

        retryButton.addEventListener('click', scan);
        readyButton.addEventListener('click', scan);
        scanAgainButton.addEventListener('click', scan);
        scan();
    })();
</script>
@endsection
