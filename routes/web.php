<?php

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/jenispembayaran', [App\Http\Controllers\BayarController::class, 'index'])->name('bayar.index');
// Route::get('/jenispembayaran', [App\Http\Controllers\BayarController::class, 'create'])->name('bayar.create');
// Route::post('/jenispembayaran', [App\Http\Controllers\BayarController::class, 'store'])->name('bayar.store');



Route::resource('/bayar', App\Http\Controllers\BayarController::class);


// ROUTE NEW
Route::resource('merks', MerksController::class);

require __DIR__ . '/auth.php';
