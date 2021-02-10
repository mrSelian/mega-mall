<?php

use App\Http\Controllers\Customer\AddressController;
use App\Http\Controllers\Shop\PageController;
use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\Seller\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\InfoController;

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

    Route::group(['prefix' => '/'], function () {
        Route::get('/', [PageController::class, 'shop'])->name('index');
        Route::post('/search', [PageController::class, 'search'])->name('search');
        Route::get('dashboard', fn() => redirect('/'))->name('dashboard');
    });

    Route::group(['prefix' => 'customer'], function () {
        Route::get('/', fn() => redirect(route('customer_orders')))->name('customer');
        Route::get('/profile', [PageController::class, 'customerProfile'])->name('customer_profile');
        Route::get('/orders', fn() => view('customer.orders'))->name('customer_orders');

        Route::group(['prefix' => 'info'], function () {
            Route::get('/create', [InfoController::class, 'create'])->name('create_customer_info');
            Route::post('/create', [InfoController::class, 'store'])->name('store_customer_info');
            Route::get('/edit', [InfoController::class, 'edit'])->name('edit_customer_info');
            Route::patch('/update', [InfoController::class, 'update'])->name('update_customer_info');
        });

        Route::group(['prefix' => 'address'], function () {
            Route::get('/create', [AddressController::class, 'create'])->name('create_address');
            Route::post('/create', [AddressController::class, 'store'])->name('store_address');
            Route::get('/edit', [AddressController::class, 'edit'])->name('edit_address');
            Route::patch('/update', [AddressController::class, 'update'])->name('update_address');
        });
    });


    Route::group(['prefix' => 'seller'], function () {
        Route::get('/', fn() => redirect(route('seller_orders')))->name('seller');
        Route::get('/profile', fn() => view('seller.profile'))->name('seller_profile');
        Route::get('/orders', fn() => view('seller.orders'))->name('seller_orders');
        Route::get('/products', [ProductController::class, 'forSeller'])->name('seller_products');

        Route::group(['prefix' => 'product'], function () {
            Route::get('/create', [ProductController::class, 'create'])->name('create_product');
            Route::post('/create', [ProductController::class, 'store'])->name('store_product');
            Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit_product');
            Route::patch('/{id}/update', [ProductController::class, 'update'])->name('update_product');
            Route::delete('/{id}/destroy', [ProductController::class, 'destroy'])->name('destroy_product');
        });
    });


    Route::group(['prefix' => 'cart'], function () {
        Route::get('/', [CartController::class, 'index'])->name('cart');
        Route::post('/clear', [CartController::class, 'clearCart'])->name('clear_cart');
        Route::post('/correct/{id}',[CartController::class, 'correctAmount'])->name('correct_amount');
//        Route::post('/actualize', [CartController::class, 'actualize'])->name('actualize_cart');
        Route::post('/to-order', [CartController::class, 'toOrder'])->name('cart_to_order');
        Route::post('/add/{id}', [CartController::class, 'addProduct'])->name('add_to_cart');
        Route::post('/remove/{id}', [CartController::class, 'removeProduct'])->name('remove_from_cart');
    });

    Route::group(['prefix' => 'product'], function () {
        Route::get('/{id}/show', [PageController::class, 'showProduct'])->name('show_product');

    });
});

//Route::middleware(['auth:sanctum', 'verified'])->get('/', [ProductController::class, 'index'])->name('index');


