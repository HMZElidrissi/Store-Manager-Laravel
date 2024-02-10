<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
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
    return view('home');
})->name('home');
Route::get('/table', function () {
    return view('table');
})->name('table');
Route::get('/table2', function () {
    return view('table2');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('showRegisterForm');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('showLoginForm');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
Route::get('/clients/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');
Route::put('/clients/{id}', [ClientController::class, 'update'])->name('clients.update');
Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');
