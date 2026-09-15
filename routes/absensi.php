<?php

use App\Http\Controllers\AbsensiAuthController;
use App\Http\Controllers\AbsensiPageController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->prefix('absensi')->name('absensi.')->group(function () {
    Route::get('/login', [AbsensiAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AbsensiAuthController::class, 'login'])->name('login.store');
    Route::post('/logout', [AbsensiAuthController::class, 'logout'])->name('logout');

    Route::middleware('auth:siswa')->group(function () {
        Route::get('/scan', [AbsensiPageController::class, 'scan'])->name('scan');
    });

    Route::middleware('auth:guru')->group(function () {
        Route::get('/piket', [AbsensiPageController::class, 'piket'])
            ->middleware('guru.role:guru_piket')
            ->name('piket');
        Route::get('/admin', [AbsensiPageController::class, 'admin'])
            ->middleware('guru.role:admin_tu')
            ->name('admin');
        Route::get('/laporan', [AbsensiPageController::class, 'laporan'])
            ->middleware('guru.role:kepsek')
            ->name('laporan');
    });
});
