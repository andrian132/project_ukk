<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\SearchController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::group(['middleware' => 'auth'], function () {
//     Route::get('/home', [HomeController::class, 'index']);
//     Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
// });

// Route::resource('kategori',KategoriController::class);
// Route::resource('barang',BarangController::class);
// Route::resource('barangmasuk',BarangMasukController::class);
// Route::resource('barangkeluar',BarangKeluarController::class);
Route::get('/stembayo', function () {
    return "welcome to SIJA";
});

Route::get('/', function () {
    return view('welcome');
});

// Route::resource('siswa',SiswaController::class)->middleware('auth');


Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});
 
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index']);
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::resource('kategori', KategoriController::class)->middleware('auth');

Route::resource('barang', BarangController::class)->middleware('auth');

Route::resource('barangmasuk', BarangMasukController::class)->middleware('auth');

Route::resource('barangkeluar', BarangKeluarController::class)->middleware('auth');
Route::get('/search', [SearchController::class, 'search'])->name('search');
