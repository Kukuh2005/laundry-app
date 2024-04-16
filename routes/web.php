<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaketController;

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

Route::get('/', function () {
    return redirect('/dashboard');
});
Route::get('/dashboard', function () {
    return view('dashboard.index');
});


Route::get('/paket', [PaketController::class, 'index']);
Route::get('/paket/satuan', [PaketController::class, 'satuan']);
Route::post('/paket/store', [PaketController::class, 'store']);
Route::get('/paket/{id}/delete', [PaketController::class, 'destroy']);
Route::get('/paket/{id}/edit', [PaketController::class, 'edit']);
Route::put('/paket/{id}/update', [PaketController::class, 'update']);