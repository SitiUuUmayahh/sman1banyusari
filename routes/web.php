<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PpdbController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/sekolah/profil', [SchoolController::class, 'profile'])->name('school.profile');
Route::get('/berita', [NewsController::class, 'index'])->name('news.index');
Route::get('/berita/{slug}', [NewsController::class, 'show'])->name('news.show');
Route::get('/ppdb', [PpdbController::class, 'index'])->name('ppdb.index');
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/galeri/{id}', [GalleryController::class, 'show'])->name('gallery.show');
Route::get('/prestasi', [AchievementController::class, 'index'])->name('achievement.index');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact.index');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');

// User Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Routes
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

// User Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
