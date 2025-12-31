<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminTransactionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\AdminUserController;

/*
|--------------------------------------------------------------------------
| PUBLIC PAGES
|--------------------------------------------------------------------------
*/
Route::controller(PageController::class)->group(function () {
    Route::get('/', 'welcome')->name('pages.welcome');
    Route::get('/tentang', 'about')->name('pages.about');
    Route::get('/kontak', 'contact')->name('pages.contact');
    Route::get('/produk', 'products')->name('pages.products');
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| USER AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user'])
    ->prefix('user')
    ->as('user.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

        // Produk
        Route::get('/products/show/{id}', [ProductController::class, 'showUser'])->name('products.show');

        // Transaksi
        Route::post('/transaction/calc', [TransactionController::class, 'calculate'])
            ->name('transaction.calculate');

        Route::post('/transactions', [TransactionController::class, 'store'])
            ->name('transactions.store');

        Route::get('/transactions', [TransactionController::class, 'index'])
            ->name('transactions');

        // Profil
        Route::get('/profile', [UserProfileController::class, 'index'])->name('profile');
        Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [UserProfileController::class, 'destroy'])->name('profile.destroy');

        // Topup saldo
        Route::get('/topup', [UserController::class, 'topup'])->name('topup');
        Route::post('/topup', [UserController::class, 'processTopup'])->name('topup.process');
    });

/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | PRODUCT MANAGEMENT
        |--------------------------------------------------------------------------
        */

        Route::get('/products', [ProductController::class, 'index'])->name('products');
        Route::get('/products/show/{id}', [ProductController::class, 'showAdmin'])->name('products.show');

        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

        // Variants
        Route::post('/products/{product}/variants', [ProductController::class, 'storeVariant'])
            ->name('products.variants.store');

        Route::delete('/products/{product}/variants/{variant}', [ProductController::class, 'destroyVariant'])
            ->name('products.variants.delete');

        /*
        |--------------------------------------------------------------------------
        | TRANSACTIONS (ADMIN)
        |--------------------------------------------------------------------------
        */
        Route::get('/transactions', [AdminTransactionController::class, 'index'])->name('transactions');
        Route::post('/transactions/{id}/status', [AdminTransactionController::class, 'updateStatus'])
            ->name('transactions.updateStatus');
        Route::delete('/transactions/{id}', [AdminTransactionController::class, 'destroy'])
            ->name('transactions.destroy');

        /*
        |--------------------------------------------------------------------------
        | TOPUP USER MANAGEMENT
        |--------------------------------------------------------------------------
        */
        Route::get('/topups', [AdminController::class, 'topups'])->name('topups');
        Route::post('/topups/{id}/approve', [AdminController::class, 'approveTopup'])
            ->name('topups.approve');
        Route::post('/topups/{id}/reject', [AdminController::class, 'rejectTopup'])
            ->name('topups.reject');

        /*
        |--------------------------------------------------------------------------
        | USER MANAGEMENT
        |--------------------------------------------------------------------------
        */
         // INDEX
        Route::get('/users', [AdminUserController::class, 'index'])
            ->name('users.index');

        // EDIT
        Route::get('/users/{id}/edit', [AdminUserController::class, 'edit'])
            ->name('users.edit');

        Route::put('/users/{id}', [AdminUserController::class, 'update'])
            ->name('users.update');

        // RIWAYAT TRANSAKSI USER
        Route::get('/users/{id}/transactions', [AdminUserController::class, 'transactions'])
            ->name('users.transactions');

        // DELETE
        Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])
            ->name('users.delete');
    });

/*
|--------------------------------------------------------------------------
| FALLBACK 404
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
