<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\sesicontroller;

use App\Http\Controllers\dashboardcontroller;
use App\Http\Controllers\gurucontroller;

Route::fallback(function () {
    return response()->view('template-admin.error', [], 404);
});

Route::get('/', [sesicontroller::class, 'tampilLogin'])->name('login');
Route::post('/login/submit', [sesicontroller::class, 'submitLogin'])->name('login.submit');
Route::post('/logout', [sesicontroller::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboardAdmin', [dashboardcontroller::class, 'dashboardAdmin'])->name('dashboard-admin');
    Route::resource('guru', gurucontroller::class);
});