<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RingController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\HistoryController;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Models\Page;

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
    return view('welcome', );
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/order', [RingController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('order');

// Route::get('/order', [RingController::class, 'types'])
//     ->middleware(['auth', 'verified'])
//     ->name('order.types');


// Route::post('/cart', [CartController::class, 'store'])
//     ->middleware(['auth', 'verified'])
//     ->name('cart.store');

//     // Route to display the cart
// Route::get('/cart', [CartController::class, 'show'])
//     ->middleware(['auth', 'verified'])
//     ->name('cart.show');

Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::delete('/cart/{orderItem}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/updateShipping', [CartController::class, 'updateShipping'])->name('cart.updateShipping');

Route::get('/checkout', [CheckoutController::class, 'checkout'])->middleware(['auth', 'verified'])->name('checkout');

Route::get('/checkout/succes', [CheckoutController::class, 'succes'])->middleware(['auth', 'verified'])->name('checkout.succes');

Route::post('/webhooks/mollie', [WebhookController::class, 'handle'])->name('webhooks.mollie');

Route::get('/payment',[PaymentController::class, 'checkout'])->middleware(['auth', 'verified'])->name('payment');

Route::get('/history', [HistoryController::class,'index'])->middleware(['auth', 'verified'])->name('history');
Route::post('/history/download', [HistoryController::class, 'downloadPDF'])->name('history.download');

// routes/web.php
Route::get('/export-orders', [HistoryController::class,'exportOrders'])->name('export.orders');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
