<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth:admin', 'admin.access'])->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('layouts.app', ['content' => 'Halaman admin sekolah']);
    })->name('admin.dashboard');

    Route::get('/users', function () {
        return view('layouts.app', ['content' => 'Kelola pengguna admin']);
    })->name('admin.users');

    Route::get('/berita', function () {
        return view('layouts.app', ['content' => 'Kelola berita']);
    })->name('admin.berita');

    Route::get('/galeri', function () {
        return view('layouts.app', ['content' => 'Kelola galeri']);
    })->name('admin.galeri');

    Route::get('/prestasi', function () {
        return view('layouts.app', ['content' => 'Kelola prestasi']);
    })->name('admin.prestasi');

    Route::get('/halaman-statis', function () {
        return view('layouts.app', ['content' => 'Kelola halaman statis']);
    })->name('admin.halaman-statis');

    Route::get('/ppdb', function () {
        return view('layouts.app', ['content' => 'Kelola PPDB']);
    })->name('admin.ppdb');
});

Route::get('/sekolah', function () {
    return view('layouts.app', ['content' => 'Halaman publik sekolah']);
})->name('school.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
