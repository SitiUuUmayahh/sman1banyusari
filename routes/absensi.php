<?php

use App\Http\Controllers\AbsensiAuthController;
use App\Http\Controllers\AbsensiAdminController;
use App\Http\Controllers\AbsensiPageController;
use App\Http\Controllers\AbsensiSiswaController;
use App\Http\Controllers\AbsensiReferenceController;
use App\Http\Controllers\AbsensiReportController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->prefix('absensi')->name('absensi.')->group(function () {
    Route::get('/login', [AbsensiAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AbsensiAuthController::class, 'login'])->name('login.store');
    Route::post('/logout', [AbsensiAuthController::class, 'logout'])->name('logout');

    Route::middleware('auth:siswa')->group(function () {
        Route::get('/scan', [AbsensiPageController::class, 'scan'])->name('scan');
        Route::post('/scan', [AbsensiPageController::class, 'processScan'])->name('scan.process');
    });

    Route::middleware('auth:guru')->group(function () {
        Route::get('/piket', [AbsensiPageController::class, 'piket'])
            ->middleware('guru.role:guru_piket')
            ->name('piket');
        Route::get('/admin', [AbsensiAdminController::class, 'dashboard'])
            ->middleware('guru.role:admin_tu')
            ->name('admin');
        Route::get('/admin/import-siswa', [AbsensiAdminController::class, 'importForm'])
            ->middleware('guru.role:admin_tu')
            ->name('admin.import-siswa');
        Route::post('/admin/import-siswa/preview', [AbsensiAdminController::class, 'previewImport'])
            ->middleware('guru.role:admin_tu')
            ->name('admin.import-preview');
        Route::post('/admin/import-siswa/confirm', [AbsensiAdminController::class, 'confirmImport'])
            ->middleware('guru.role:admin_tu')
            ->name('admin.import-confirm');
        Route::post('/admin/import-siswa/cancel', [AbsensiAdminController::class, 'cancelImport'])
            ->middleware('guru.role:admin_tu')
            ->name('admin.import-cancel');
        Route::get('/admin/import-siswa/template', [AbsensiAdminController::class, 'downloadTemplate'])
            ->middleware('guru.role:admin_tu')
            ->name('admin.import-template');
        Route::get('/admin/siswa', [AbsensiSiswaController::class, 'index'])
            ->middleware('guru.role:admin_tu')
            ->name('admin.siswa.index');
        Route::get('/admin/siswa/create', [AbsensiSiswaController::class, 'create'])
            ->middleware('guru.role:admin_tu')
            ->name('admin.siswa.create');
        Route::post('/admin/siswa', [AbsensiSiswaController::class, 'store'])
            ->middleware('guru.role:admin_tu')
            ->name('admin.siswa.store');
        Route::get('/admin/siswa/{student}/edit', [AbsensiSiswaController::class, 'edit'])
            ->middleware('guru.role:admin_tu')
            ->name('admin.siswa.edit');
        Route::put('/admin/siswa/{student}', [AbsensiSiswaController::class, 'update'])
            ->middleware('guru.role:admin_tu')
            ->name('admin.siswa.update');
        Route::delete('/admin/siswa/{student}', [AbsensiSiswaController::class, 'destroy'])
            ->middleware('guru.role:admin_tu')
            ->name('admin.siswa.destroy');
        Route::get('/admin/kelas', [AbsensiReferenceController::class, 'kelasIndex'])->middleware('guru.role:admin_tu')->name('admin.kelas.index');
        Route::get('/admin/kelas/create', [AbsensiReferenceController::class, 'kelasCreate'])->middleware('guru.role:admin_tu')->name('admin.kelas.create');
        Route::post('/admin/kelas', [AbsensiReferenceController::class, 'kelasStore'])->middleware('guru.role:admin_tu')->name('admin.kelas.store');
        Route::get('/admin/kelas/{class}/edit', [AbsensiReferenceController::class, 'kelasEdit'])->middleware('guru.role:admin_tu')->name('admin.kelas.edit');
        Route::put('/admin/kelas/{class}', [AbsensiReferenceController::class, 'kelasUpdate'])->middleware('guru.role:admin_tu')->name('admin.kelas.update');
        Route::delete('/admin/kelas/{class}', [AbsensiReferenceController::class, 'kelasDestroy'])->middleware('guru.role:admin_tu')->name('admin.kelas.destroy');
        Route::get('/admin/jadwal-piket', [AbsensiReferenceController::class, 'jadwalIndex'])->middleware('guru.role:admin_tu')->name('admin.jadwal-piket.index');
        Route::get('/admin/jadwal-piket/create', [AbsensiReferenceController::class, 'jadwalCreate'])->middleware('guru.role:admin_tu')->name('admin.jadwal-piket.create');
        Route::post('/admin/jadwal-piket', [AbsensiReferenceController::class, 'jadwalStore'])->middleware('guru.role:admin_tu')->name('admin.jadwal-piket.store');
        Route::get('/admin/jadwal-piket/{schedule}/edit', [AbsensiReferenceController::class, 'jadwalEdit'])->middleware('guru.role:admin_tu')->name('admin.jadwal-piket.edit');
        Route::put('/admin/jadwal-piket/{schedule}', [AbsensiReferenceController::class, 'jadwalUpdate'])->middleware('guru.role:admin_tu')->name('admin.jadwal-piket.update');
        Route::delete('/admin/jadwal-piket/{schedule}', [AbsensiReferenceController::class, 'jadwalDestroy'])->middleware('guru.role:admin_tu')->name('admin.jadwal-piket.destroy');
        Route::get('/admin/qr-gerbang', [AbsensiReferenceController::class, 'qrIndex'])->middleware('guru.role:admin_tu')->name('admin.qr-gerbang.index');
        Route::get('/admin/qr-gerbang/create', [AbsensiReferenceController::class, 'qrCreate'])->middleware('guru.role:admin_tu')->name('admin.qr-gerbang.create');
        Route::post('/admin/qr-gerbang', [AbsensiReferenceController::class, 'qrStore'])->middleware('guru.role:admin_tu')->name('admin.qr-gerbang.store');
        Route::get('/admin/qr-gerbang/{gate}/edit', [AbsensiReferenceController::class, 'qrEdit'])->middleware('guru.role:admin_tu')->name('admin.qr-gerbang.edit');
        Route::put('/admin/qr-gerbang/{gate}', [AbsensiReferenceController::class, 'qrUpdate'])->middleware('guru.role:admin_tu')->name('admin.qr-gerbang.update');
        Route::delete('/admin/qr-gerbang/{gate}', [AbsensiReferenceController::class, 'qrDestroy'])->middleware('guru.role:admin_tu')->name('admin.qr-gerbang.destroy');
        Route::get('/admin/laporan', [AbsensiReportController::class, 'laporan'])->middleware('guru.role:admin_tu')->name('admin.laporan');
        Route::get('/admin/laporan/export', [AbsensiReportController::class, 'export'])->middleware('guru.role:admin_tu')->name('admin.laporan.export');
        Route::get('/admin/notifikasi-wa', [AbsensiReportController::class, 'notifikasi'])->middleware('guru.role:admin_tu')->name('admin.notifikasi-wa');
        Route::get('/laporan', [AbsensiPageController::class, 'laporan'])
            ->middleware('guru.role:kepsek')
            ->name('laporan');
    });
});
