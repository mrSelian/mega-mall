<?php

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

Route::get ('/',[ProductController::class, 'index'] )->name('index');

Route::post('/product/create',[ProductController::class, 'store'] )->name('store');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [ProductController::class, 'for_user'])->name('dashboard');
Route::get ('product/{id}/edit',[ProductController::class, 'edit'] )->name('edit_product');
Route::patch ('product/{id}/update',[ProductController::class, 'update'] )->name('update_product');
Route::delete ('product/{id}/destroy',[ProductController::class, 'destroy'] )->name('destroy_product');
