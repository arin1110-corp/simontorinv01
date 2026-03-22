<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomepageController;

Route::get('/', function () {
    return view('home.simontorin');
});
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::get('/logout', function () {
    return view('logout');
})->name('logout');

// lihat detail saat scan
Route::get('/inventaris/{id}', [HomepageController::class, 'show'])->name('inventaris.show');


Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

Route::get('/admin/inventaris', [AdminController::class, 'inventarisIndex'])->name('admin.inventaris.index');
Route::post('/admin/inventaris/input', [AdminController::class, 'inventarisInput'])->name('admin.inventaris.input');
Route::put('/admin/inventaris/update/{id}', [AdminController::class, 'inventarisUpdate'])->name('admin.inventaris.update');
// generate barcode
Route::get('/admin/inventaris/barcode/{id}', [AdminController::class, 'generateBarcode'])->name('admin.inventaris.barcode');
// download barcode
Route::get('/admin/inventaris/barcode/download/{id}', [AdminController::class, 'downloadBarcode']);
Route::get('/barcode/download/{id}', [AdminController::class, 'downloadPDF']);

Route::post('/admin/jenis/inventaris/input', [AdminController::class, 'jenisInventarisInput'])->name('admin.jenis.input');
Route::put('/admin/jenis/inventaris/update/{id}', [AdminController::class, 'jenisInventarisUpdate'])->name('admin.jenis.update');

Route::get('/admin/perbaikan', [AdminController::class, 'perbaikanIndex'])->name('admin.perbaikan.index');

Route::get('/admin/peminjaman', [AdminController::class, 'peminjamanIndex'])->name('admin.peminjaman.index');

Route::get('/admin/booking', [AdminController::class, 'bookingIndex'])->name('admin.booking.index');

Route::get('/admin/users', [AdminController::class, 'usersIndex'])->name('admin.users.index');




Route::get('/login/admin', function () {
    return view('loginadmin');
})->name('login.admin');

Route::get('/admin/login', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'loginAdmin'])->name('admin.login.submit');

Route::post('/cek-kode', function (Request $request) {
    $kode = $request->input('kode');

    if ($kode === 'ABC123') {
        return back()->with('success', '✅ Kode valid!');
    }

    return back()->with('error', '❌ Kode tidak valid!');
})->name('cek.kode');