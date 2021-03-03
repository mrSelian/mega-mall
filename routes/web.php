<?php

use App\Http\Controllers\Customer\AddressController;
use App\Http\Controllers\Seller\OrderController;
use App\Http\Controllers\Seller\ShopProfileController;
use App\Http\Controllers\Shop\PageController;
use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\Seller\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\CustomerController;

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
        Route::get('/', [PageController::class, 'showShop'])->name('index');
        Route::post('/search', [\App\Http\Controllers\Shop\ProductController::class, 'search'])->name('search');
        Route::get('/search', fn() => redirect(route('index')));
        Route::get('dashboard', fn() => redirect('/'))->name('dashboard');
    });

    Route::group(['prefix' => 'shop'], function () {
        Route::get('/{id}', [PageController::class, 'showSellerShop'])->name('seller_page');
    });

    Route::group(['prefix' => 'order'], function () {
        Route::post('/{id}', [OrderController::class, 'changeStatus'])->name('change_order_status');
    });

    Route::group(['prefix' => 'customer'], function () {
        Route::get('/', fn() => redirect(route('customer_orders')))->name('customer');
        Route::get('/profile', [CustomerController::class, 'showProfile'])->name('customer_profile');
        Route::get('/orders', [\App\Http\Controllers\Customer\OrderController::class, 'getAllByCustomer'])->name('customer_orders');
        Route::get('/order/{id}', [\App\Http\Controllers\Customer\OrderController::class, 'show'])->name('customer_order_page');

        Route::group(['prefix' => 'info'], function () {
            Route::get('/create', [CustomerController::class, 'create'])->name('create_customer_info');
            Route::post('/create', [CustomerController::class, 'store'])->name('store_customer_info');
            Route::get('/edit', [CustomerController::class, 'edit'])->name('edit_customer_info');
            Route::patch('/update', [CustomerController::class, 'update'])->name('update_customer_info');
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
        Route::get('/profile', [ShopProfileController::class, 'showProfile'])->name('seller_profile');
        Route::get('/orders', [OrderController::class, 'getAllBySeller'])->name('seller_orders');
        Route::get('/products', [ProductController::class, 'getProducts'])->name('seller_products');
        Route::get('/order/{id}', [OrderController::class, 'show'])->name('seller_order_page');

        Route::group(['prefix' => 'info'], function () {
            Route::get('/create', [ShopProfileController::class, 'create'])->name('create_seller_info');
            Route::post('/create', [ShopProfileController::class, 'store'])->name('store_seller_info');
            Route::get('/edit', [ShopProfileController::class, 'edit'])->name('edit_seller_info');
            Route::patch('/update', [ShopProfileController::class, 'update'])->name('update_seller_info');
        });

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
        Route::post('/clear', [CartController::class, 'clear'])->name('clear_cart');
        Route::post('/correct/{id}',[CartController::class, 'correctAmount'])->name('correct_amount');
//        Route::post('/actualize', [CartController::class, 'actualize'])->name('actualize_cart');
        Route::post('/to-order', [CartController::class, 'order'])->name('cart_to_order');
        Route::post('/add/{id}', [CartController::class, 'addProduct'])->name('add_to_cart');
        Route::post('/remove/{id}', [CartController::class, 'removeProduct'])->name('remove_from_cart');
    });

    Route::group(['prefix' => 'product'], function () {
        Route::get('/{id}/show', [\App\Http\Controllers\Shop\ProductController::class, 'show'])->name('show_product');

    });
});

//Route::middleware(['auth:sanctum', 'verified'])->get('/', [ProductController::class, 'index'])->name('index');


