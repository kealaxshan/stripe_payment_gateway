<?php

use App\Http\Controllers\ProductController;
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
    Route::get('/Products', [ProductController::class, 'index'])->name('getProducts');
    Route::get('/Products/{id}', [ProductController::class, 'show'])->name('singleProduct');
    Route::post('/checkout/{id}', [ProductController::class, 'checkout'])->name('stripe.checkout');
    
    Route::get('/checkout/success', [ProductController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/cancel', [ProductController::class, 'cancel'])->name('checkout.cancel');
    Route::get('invoice/download/{orderList_id}', [ProductController::class, 'downloadInvoice'])->name('invoice.download');
});

require __DIR__ . '/auth.php';
