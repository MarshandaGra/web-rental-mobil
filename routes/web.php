<?php


use App\Http\Controllers\MerksController;
use App\Http\Controllers\MobilsController;


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


// ROUTE NEW
Route::resource('merks', MerksController::class);
Route::resource('mobils', MobilsController::class);
=======




// ROUTE MERK
Route::resource('merks', App\Http\Controllers\MerksController::class);

// ROUTE BAYAR
Route::resource('bayar', App\Http\Controllers\BayarController::class);

// ROUTE PEMESAN
Route::resource('pemesan', App\Http\Controllers\PemesanController::class);



require __DIR__ . '/auth.php';
