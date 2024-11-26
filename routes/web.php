<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CobaController;
use App\Http\Controllers\BayarController;
use App\Http\Controllers\MerksController;
use App\Http\Controllers\MobilsController;
use App\Http\Controllers\PemesanController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PesanannController;
use App\Http\Controllers\PesanansController;
use App\Http\Controllers\DashboardController;
use App\Models\Mobil;
use App\Models\merk;


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
    return view('welcome');
});


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    // ROUTE NEW
    Route::resource('merks', MerksController::class);
    Route::resource('mobils', MobilsController::class);
    Route::resource('pemesans', PemesanController::class);
    Route::resource('bayar', BayarController::class);
    // PESANAN
    Route::resource('pesanan', PesanannController::class);
    // route pengembalian
    Route::post('pesanan/{id}/kembali', [PesanannController::class, 'kembali'])->name('pesanan.kembali');
    Route::get('pesanan{id}/kembali', [PesanannController::class, 'formDenda'])->name('pesanan.kembali.form');
    Route::get('/riwayat', [PesanannController::class, 'riwayat'])->name('penyewaan.riwayat');
});






require __DIR__ . '/auth.php';
