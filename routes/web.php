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

Route::group(['middleware' => ['auth', 'ceklevel:Admin']], function(){
    Route::get('Admin/dashboard', [DashboardController::class, 'index']);

    Route::get('Admin/paket', [PaketController::class, 'index']);
    Route::get('Admin/paket/satuan', [PaketController::class, 'satuan']);
    Route::post('Admin/paket/store', [PaketController::class, 'store']);
    Route::get('Admin/paket/{id}/delete', [PaketController::class, 'destroy']);
    Route::get('Admin/paket/{id}/edit', [PaketController::class, 'edit']);
    Route::put('Admin/paket/{id}/update', [PaketController::class, 'update']);
    
    Route::get('Admin/pelanggan', [PelangganController::class, 'index']);
    Route::post('Admin/pelanggan/store', [PelangganController::class, 'store']);
    Route::get('Admin/pelanggan/{id}/delete', [PelangganController::class, 'destroy']);
    Route::get('Admin/pelanggan/{id}/edit', [PelangganController::class, 'edit']);
    Route::put('Admin/pelanggan/{id}/update', [PelangganController::class, 'update']);
    
    Route::get('Admin/transaksi', [TransaksiSementaraController::class, 'index']);
    Route::get('Admin/transaksi/{pelanggan_id}', [TransaksiSementaraController::class, 'create']);
    Route::post('Admin/transaksi/{pelanggan_id}/store', [TransaksiSementaraController::class, 'store']);
    Route::get('Admin/transaksi/{id}/{pelanggan_id}/delete', [TransaksiSementaraController::class, 'destroy']);
    
    Route::post('Admin/transaksi/{pelanggan_id}/bayar', [TransaksiController::class, 'bayar']);
    Route::get('Admin/transaksi/{kode}/edit', [TransaksiController::class, 'edit']);
    Route::get('Admin/transaksi/{kode}/detail', [TransaksiController::class, 'show']);
    
    Route::put('Admin/transaksi/{id}/{kode}/update-status', [TransaksiDetailController::class, 'update']);

    Route::put('Admin/outlet/update', [OutletController::class, 'update']);
});

Route::group(['middleware' => ['auth', 'ceklevel:Karyawan']], function(){
    Route::get('Karyawan/dashboard', [DashboardController::class, 'index']);
    
    Route::get('Karyawan/pelanggan', [PelangganController::class, 'index']);
    Route::post('Karyawan/pelanggan/store', [PelangganController::class, 'store']);
    Route::get('Karyawan/pelanggan/{id}/delete', [PelangganController::class, 'destroy']);
    Route::get('Karyawan/pelanggan/{id}/edit', [PelangganController::class, 'edit']);
    Route::put('Karyawan/pelanggan/{id}/update', [PelangganController::class, 'update']);
    
    Route::get('Karyawan/transaksi', [TransaksiSementaraController::class, 'index']);
    Route::get('Karyawan/transaksi/{pelanggan_id}', [TransaksiSementaraController::class, 'create']);
    Route::post('Karyawan/transaksi/{pelanggan_id}/store', [TransaksiSementaraController::class, 'store']);
    Route::get('Karyawan/transaksi/{id}/{pelanggan_id}/delete', [TransaksiSementaraController::class, 'destroy']);
    
    Route::post('Karyawan/transaksi/{pelanggan_id}/bayar', [TransaksiController::class, 'bayar']);
    Route::get('Karyawan/transaksi/{kode}/edit', [TransaksiController::class, 'edit']);
    Route::get('Karyawan/transaksi/{kode}/detail', [TransaksiController::class, 'show']);
    
    Route::put('Karyawan/transaksi/{id}/{kode}/update-status', [TransaksiDetailController::class, 'update']);
    
    Route::get('Karyawan/order', [OrderController::class, 'index']);
    Route::get('Karyawan/order/proses', [OrderController::class, 'proses']);
    Route::get('Karyawan/order/siap-ambil', [OrderController::class, 'siap']);
    Route::get('Karyawan/order/selesai', [OrderController::class, 'selesai']);
    Route::put('Karyawan/order/{id}/update', [OrderController::class, 'update']);
});