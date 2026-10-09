<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

/* ---------------- Admin ---------------- */
Route::prefix('admin')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'show'])->name('admin.login');
        Route::post('login', [AuthController::class, 'login'])->name('admin.login.attempt');
    });

    Route::middleware('auth')->group(function () {
        Route::view('/', 'admin.dashboard')->name('admin.dashboard');
        Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');
    });
});
