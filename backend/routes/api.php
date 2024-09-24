<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('products/index', [ProductController::class, 'index'])->name('products.index');
Route::get('product/{id}/show', [ProductController::class, 'show'])->whereNumber('id')->name('product.show');
Route::post('product/store', [ProductController::class, 'store'])->name('product.store');
Route::get('product/{id}/edit', [ProductController::class, 'edit'])->whereNumber('id')->name('product.edit');
Route::put('product/{id}/update', [ProductController::class, 'update'])->whereNumber('id')->name('product.update');
Route::delete('product/{id}/destroy', [ProductController::class, 'destroy'])->whereNumber('id')->name('product.destroy');
