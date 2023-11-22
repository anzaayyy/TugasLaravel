<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home_page');
Route::get('/user', [HomeController::class, 'index2'])->name('homeuser');
Route::get('/bunga/{id}/detail', [HomeController::class, 'show'])->name('bunga.detail');
Route::get('/user', [HomeController::class, 'index2'])->name('homeuser');
Route::post('/bunga/{id}/beli', [HomeController::class, 'beli'])->name('bunga.beli');
Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index1'])->name('bunga.home');
    Route:: post('/admin', [HomeController::class, 'store']) ->name("bunga.store");
    Route::get('/admin/create', [HomeController::class, 'create'])->name('bunga.create');
    Route::get('/admin/{flowers}/edit', [HomeController::class, 'edit']) ->name("bunga.edit");
    Route::post('/admin/{flowers}', [HomeController::class, 'update']) ->name("bunga.update");
    Route::delete('/admin/{flowers}', [HomeController::class, 'destroy']) ->name("bunga.destroy");
});


