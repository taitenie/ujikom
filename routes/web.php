<?php

use App\Http\Controllers\Admin\UserManagementController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Redirect root "/" ke login jika belum login,
| atau ke dashboard berdasarkan role jika sudah login
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login.form');
});

/*
|--------------------------------------------------------------------------
| Public Authentication Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'index'])->name('register.form');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');

    Route::get('/login', [LoginController::class, 'index'])->name('login.form');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', fn() => match (Auth::user()->role) {
        'admin' => app(AdminController::class)->index(),
        'user' => app(UserController::class)->index(),
        default => abort(403),
    })->name('dashboard');

    Route::middleware('role:user')->group(function () {
        Route::get('/filter/{category}', [UserController::class, 'filterByCategory'])->name('product.filter');
        Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    });

    Route::middleware('role:admin')->group(function () {
        Route::resource('/users', UserManagementController::class);
        Route::resource('/orders', UserManagementController::class);
        Route::resource('/categories', CategoryController::class);
        Route::resource('/shops', UserManagementController::class);
    });


    Route::prefix('cart')->group(function () {
        Route::post('/add', [CartController::class, 'add'])->name('cart.add');
        Route::post('/update', [CartController::class, 'update'])->name('cart.update');
        Route::delete('/remove', [CartController::class, 'remove'])->name('cart.remove');
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
    });

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
