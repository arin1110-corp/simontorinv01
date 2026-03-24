<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('home.simontorin');
});
Route::get('/login', function () {
    return view('home.simontorin');
})->name('login.form');

Route::post('/login', [HomepageController::class, 'login'])->name('login.process');
Route::post('/set-role', [HomepageController::class, 'setRole'])->name('set.role');
Route::get('/logout', [HomepageController::class, 'logout'])->name('logout');

// lihat detail saat scan
Route::get('/inventaris/{id}', [HomepageController::class, 'show'])->name('inventaris.show');

Route::middleware(['role:Admin'])->group(function () {
    /*Admin Routes*/
    // Dashboard
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    // Inventaris
    Route::get('/admin/inventaris', [AdminController::class, 'inventarisIndex'])->name('admin.inventaris.index');
    Route::post('/admin/inventaris/input', [AdminController::class, 'inventarisInput'])->name('admin.inventaris.input');
    Route::put('/admin/inventaris/update/{id}', [AdminController::class, 'inventarisUpdate'])->name('admin.inventaris.update');
    // generate barcode
    Route::get('/admin/inventaris/barcode/{id}', [AdminController::class, 'generateBarcode'])->name('admin.inventaris.barcode');
    // download barcode
    Route::get('/admin/inventaris/barcode/download/{id}', [AdminController::class, 'downloadBarcode']);
    Route::get('/barcode/download/{id}', [AdminController::class, 'downloadPDF']);
    //Jenis Inventaris
    Route::post('/admin/jenis/inventaris/input', [AdminController::class, 'jenisInventarisInput'])->name('admin.jenis.input');
    Route::put('/admin/jenis/inventaris/update/{id}', [AdminController::class, 'jenisInventarisUpdate'])->name('admin.jenis.update');
    // Atribut Inventaris
    Route::post('/admin/atribut/inventaris/input', [AdminController::class, 'atributInventarisInput'])->name('admin.atribut.input');
    Route::put('/admin/atribut/inventaris/update/{id}', [AdminController::class, 'atributInventarisUpdate'])->name('admin.atribut.update');
    // KIR
    Route::get('/admin/kir', [AdminController::class, 'kirIndex'])->name('admin.kir.index');
    //Lokasi
    Route::post('/admin/lokasi/input', [AdminController::class, 'lokasiInput'])->name('admin.lokasi.input');
    Route::put('/admin/lokasi/update/{id}', [AdminController::class, 'lokasiUpdate'])->name('admin.lokasi.update');
    // Perbaikan
    Route::get('/admin/perbaikan', [AdminController::class, 'perbaikanIndex'])->name('admin.perbaikan.index');
    // Peminjaman
    Route::get('/admin/peminjaman', [AdminController::class, 'peminjamanIndex'])->name('admin.peminjaman.index');
    // Booking
    Route::get('/admin/booking', [AdminController::class, 'bookingIndex'])->name('admin.booking.index');
    // Pengguna
    Route::get('/admin/users', [AdminController::class, 'usersIndex'])->name('admin.users.index');

    /* End Admin Routes */
});
Route::middleware(['role:Pegawai'])->group(function () {
    /* Start User Routes */
    Route::get('/user', [UserController::class, 'userIndex'])->name('user.index');

    /* End User Routes */
});