<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SearchController;

use App\Http\Controllers\HomeController;


Route::get('/', function () {
    return view('welcome');

    // Route::get('/dashboard2', function () {
    //     return view('dashboard2');
    // });
    
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('barang', BarangController::class)->middleware('auth');
Route::resource('barangmasuk', BarangMasukController::class)->middleware('auth');
Route::resource('barangkeluar', BarangKeluarController::class)->middleware('auth');
Route::resource('kategori', KategoriController::class)->middleware('auth');
// Route::resource('siswa',SiswaController::class);
// register
Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
 // login
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});
//  logout
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index']);
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});
Route::get('/search', [SearchController::class, 'search'])->name('search');