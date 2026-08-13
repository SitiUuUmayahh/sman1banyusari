<?php

use Illuminate\Support\Facades\Route;

Route::middleware('web')->prefix('absensi')->name('absensi.')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('index');

    Route::get('/harian', function () {
        return view('welcome');
    })->name('harian');
});
