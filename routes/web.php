<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
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

// Rute untuk halaman utama      
Route::get('/', function () {
    return view('auth.login');
});

// Rute untuk dashboard      
Route::middleware(['auth', 'verified'])->group(function () {
    // Rute untuk dashboard  
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rute untuk profil pengguna      
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Rute untuk transaksi      
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');

    // Rute untuk produk dan pengguna, hanya untuk admin      
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('products', ProductController::class);
        Route::resource('users', UserController::class);
    });

    // Rute untuk melihat produk (semua pengguna)      
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

    // Rute untuk pembelian produk      
    Route::post('/products/{product}/purchase', [TransactionController::class, 'purchase'])->name('products.purchase');
    Route::get('/products/{product}/confirm', [TransactionController::class, 'confirm'])->name('products.confirm');
});

// Rute untuk autentikasi      
require __DIR__ . '/auth.php';
