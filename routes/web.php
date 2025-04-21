<?php

use App\Http\Controllers\Admin\UserManagementController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderManagementController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopCreationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StrukController;

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

        Route::prefix('cart')->group(function () {
            Route::get('/', [CartController::class, 'index'])->name('cart.index');

            Route::post('/items', [CartItemController::class, 'store'])->name('cart.items.store');
            Route::patch('/items/{item}', [CartItemController::class, 'update'])->name('cart.items.update');
            Route::delete('/items/{item}', [CartItemController::class, 'destroy'])->name('cart.items.destroy');

            Route::post('/checkout', [OrderController::class, 'checkout'])->name('cart.checkout');
        });

        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');

        Route::get('/profile', [ProfileController::class, "index"])->name('profile.index');
        Route::get('/struk/{struk}', [StrukController::class, 'show'])->name('struk.show');
    });

    Route::middleware('role:admin')->group(function () {
        Route::resource('/users', UserManagementController::class);

        Route::get('/order', [OrderManagementController::class, 'index'])->name('admin.orders.index');
        Route::get('/order/{order}', [OrderManagementController::class, 'show'])->name('admin.orders.show');
        Route::patch('/order/{order}/{status}', [OrderManagementController::class, 'updateStatus'])->name('admin.orders.updateStatus');

        Route::resource('/categories', CategoryController::class);
        Route::resource('/shops', ShopCreationController::class);
    });

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
