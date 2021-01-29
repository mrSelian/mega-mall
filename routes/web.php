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

Route::middleware(['auth:sanctum', 'verified'])->get('/', [ProductController::class, 'index'])->name('index');

Route::middleware(['auth:sanctum', 'verified'])->get('cart', [CartController::class, 'index'])->name('cart');

Route::post('/product/create', [ProductController::class, 'store'])->name('store');

//позде этот роут будет вести на заказы покупателя
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard/seller', [ProductController::class, 'for_user'])->name('seller');
Route::get('product/{id}/edit', [ProductController::class, 'edit'])->name('edit_product');
Route::get('product/{id}', [ProductController::class, 'show'])->name('show_product');
Route::patch('product/{id}/update', [ProductController::class, 'update'])->name('update_product');
Route::delete('product/{id}/destroy', [ProductController::class, 'destroy'])->name('destroy_product');
