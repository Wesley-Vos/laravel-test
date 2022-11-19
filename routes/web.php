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

Route::get('/', 'HomeController@index');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::post('/products/new', [ProductController::class, 'new'])->name('products.new');
Route::delete('/products/delete/{product}', [ProductController::class, 'delete'])->name('products.delete');
