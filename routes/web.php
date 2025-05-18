<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\gurucontroller;
use App\Http\Controllers\ortucontroller;

use App\Http\Controllers\sesicontroller;

use App\Http\Controllers\usercontroller;

use App\Http\Controllers\absencontroller;

use App\Http\Controllers\localcontroller;
use App\Http\Controllers\rekapcontroller;
use App\Http\Controllers\siswacontroller;
use App\Http\Controllers\jurusancontroller;
use App\Http\Controllers\dashboardcontroller;
use App\Http\Controllers\walikelascontroller;

Route::fallback(function () {
    return response()->view('template-admin.error', [], 404);
});

Route::get('/', [sesicontroller::class, 'tampilLogin'])->name('login');
Route::post('/login/submit', [sesicontroller::class, 'submitLogin'])->name('login.submit');
Route::post('/logout', [sesicontroller::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboardAdmin', [dashboardcontroller::class, 'dashboardAdmin'])->name('dashboard-admin');
    
    Route::resource('siswa', siswacontroller::class);
    Route::resource('jurusan', jurusancontroller::class);
    Route::resource('local', localcontroller::class);
    Route::resource('walikelas', walikelascontroller::class);
    Route::resource('guru', gurucontroller::class);
    Route::resource('user', usercontroller::class);
    
    Route::get('/dashboardGuru', [dashboardcontroller::class, 'dashboardGuru'])->name('dashboard-guru');
    Route::resource('absen', AbsenController::class);
    Route::post('absen/updateStatus', [AbsenController::class, 'updateStatus'])->name('absen.updateStatus');
    Route::get('absen/{id}/edit', [AbsenController::class, 'edit'])->name('absen.edit');
    Route::put('absen/{id}', [AbsenController::class, 'update'])->name('absen.update');
});