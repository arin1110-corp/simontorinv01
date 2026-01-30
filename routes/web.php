<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home.simontorin');
});
Route::get('/login/nipnik', function () {
    return view('loginnipnik');
})->name('login.nipnik');

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