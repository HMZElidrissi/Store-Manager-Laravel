<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SaleController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware('auth')->name('dashboard');

Route::group(['middleware' => 'guest'], function () {
    // Register and login routes
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('showRegisterForm');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('showLoginForm');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    // Password reset link request routes...
    Route::get('/password/reset', [AuthController::class, 'forgotPassword'])->name('password.request');
    Route::post('/password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');

    // Password reset routes...
    Route::get('/password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [AuthController::class, 'reset'])->name('password.update');
});

Route::group(['middleware' => 'auth'], function () {
    // logout route
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // clients routes
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/clients/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');
    Route::put('/clients/{id}', [ClientController::class, 'update'])->name('clients.update');
    Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');

    // categories routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // products routes
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::post('/products/buy', [SaleController::class, 'buy'])->name('products.buy');

    // permissions routes
    Route:: get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route:: get('/permissions/add', [PermissionController::class, 'add'])->name('permissions.add');
    Route:: post('/permissions/assign', [PermissionController::class, 'assign'])->name('permissions.assign');
    Route:: post('/permissions/revoke/{role}/{permission}', [PermissionController::class, 'revoke'])->name('permissions.revoke');

    // sales routes
    Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
    Route::put('/sales/{id}', [SaleController::class, 'markAsDelivered'])->name('sales.markAsDelivered');
    Route::get('/mysales', [SaleController::class, 'show'])->name('mysales');
});
