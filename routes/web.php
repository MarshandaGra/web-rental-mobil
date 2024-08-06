<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MerksController;
use App\Http\Controllers\MobilsController;
use App\Http\Controllers\PemesanController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PesanannController;
use App\Http\Controllers\PesanansController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


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

    // PESANAN
    Route::resource('pesanan', PesanannController::class);
    // route pengembalian
    Route::post('pesanan/{id}/kembali', [PesanannController::class, 'kembali'])->name('pesanan.kembali');
    Route::get('pesanan{id}/kembali', [PesanannController::class, 'formDenda'])->name('pesanan.kembali.form');
    Route::get('/riwayat', [PesanannController::class, 'riwayat'])->name('penyewaan.riwayat');
});





// // ROUTE MERK
// Route::resource('merks', App\Http\Controllers\MerksController::class);

// ROUTE BAYAR
Route::resource('bayar', App\Http\Controllers\BayarController::class);





require __DIR__ . '/auth.php';
