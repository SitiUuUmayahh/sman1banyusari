<?php

use Illuminate\Support\Facades\Route;

// Breeze auth routes were removed in favor of Filament admin auth.
// The application uses AdminUser via the admin panel only.

Route::middleware('web')->group(function () {
    // No legacy Breeze auth routes remain.
});
