<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TransaksiSementaraController;
use App\Http\Controllers\TransaksiDetailController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OutletController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'home'])->name('home');

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/postlogin', [AuthController::class, 'postlogin']);
Route::get('/daftar', [AuthController::class, 'daftar']);
Route::post('/user/daftar', [AuthController::class, 'store'])->name('store');
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/cek-order', [OrderController::class, 'cek']);
Route::get('/cek-order/cari', [OrderController::class, 'cari']);

Route::group(['middleware' => ['auth', 'ceklevel:Admin,Karyawan']], function(){
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/paket', [PaketController::class, 'index']);
    Route::get('/paket/satuan', [PaketController::class, 'satuan']);
    Route::post('/paket/store', [PaketController::class, 'store']);
    Route::get('/paket/{id}/delete', [PaketController::class, 'destroy']);
    Route::get('/paket/{id}/edit', [PaketController::class, 'edit']);
    Route::put('/paket/{id}/update', [PaketController::class, 'update']);
    
    Route::get('/pelanggan', [PelangganController::class, 'index']);
    Route::post('/pelanggan/store', [PelangganController::class, 'store']);
    Route::get('/pelanggan/{id}/delete', [PelangganController::class, 'destroy']);
    Route::get('/pelanggan/{id}/edit', [PelangganController::class, 'edit']);
    Route::put('/pelanggan/{id}/update', [PelangganController::class, 'update']);
    
    Route::get('/transaksi', [TransaksiSementaraController::class, 'index']);
    Route::get('/transaksi/{pelanggan_id}', [TransaksiSementaraController::class, 'create']);
    Route::post('/transaksi/{pelanggan_id}/store', [TransaksiSementaraController::class, 'store']);
    Route::get('/transaksi/{id}/{pelanggan_id}/delete', [TransaksiSementaraController::class, 'destroy']);
    
    Route::post('/transaksi/{pelanggan_id}/bayar', [TransaksiController::class, 'bayar']);
    Route::get('/transaksi/{kode}/edit', [TransaksiController::class, 'edit']);
    Route::get('/transaksi/{kode}/detail', [TransaksiController::class, 'show']);
    
    Route::put('/transaksi/{id}/{kode}/update-status', [TransaksiDetailController::class, 'update']);
    
    Route::get('/order', [OrderController::class, 'index']);
    Route::get('/order/proses', [OrderController::class, 'proses']);
    Route::get('/order/siap-ambil', [OrderController::class, 'siap']);
    Route::get('/order/selesai', [OrderController::class, 'selesai']);
    Route::put('/order/{id}/update', [OrderController::class, 'update']);

    Route::put('/outlet/update', [OutletController::class, 'update']);
});