<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::get('/', [ProductController::class, 'index'])->name('index');

    Route::group(['prefix' => '/'], function () {
        Route::get('cart', [CartController::class, 'index'])->name('cart');
        Route::get('customer', function () {
            return view('customer');
        })->name('customer');
        Route::get('seller', [ProductController::class, 'for_user'])->name('seller');
    });


    Route::group(['prefix' => 'cart'], function () {
        Route::post('/clear', [CartController::class, 'clearCart'])->name('clear_cart');
        Route::post('/actualize', [CartController::class, 'actualize'])->name('actualize_cart');
        Route::post('/to-order', [CartController::class, 'toOrder'])->name('cart_to_order');
    });

    Route::group(['prefix' => 'product'], function () {
        Route::post('/create', [ProductController::class, 'store'])->name('store');
        Route::get('/{id}', [ProductController::class, 'show'])->name('show_product');
        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit_product');
        Route::patch('/{id}/update', [ProductController::class, 'update'])->name('update_product');
        Route::delete('/{id}/destroy', [ProductController::class, 'destroy'])->name('destroy_product');
        Route::post('/{id}/add-to-cart', [CartController::class, 'addProduct'])->name('add_to_cart');
        Route::post('/{id}/remove-from-cart', [CartController::class, 'removeProduct'])->name('remove_from_cart');
    });


});

//Route::middleware(['auth:sanctum', 'verified'])->get('/', [ProductController::class, 'index'])->name('index');


