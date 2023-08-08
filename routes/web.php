<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('items')->group(function () {
    Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);
    Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::post('/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::delete('/delete/{itemId}', [App\Http\Controllers\ItemController::class, 'delete'])->name('/delete/{itemId}');
});


// 行先登録のルート
Route::prefix('plans')->group(function() {
    Route::get('/', App\Http\Controllers\Plan\IndexController::class)->name('home');
    Route::get('/create', App\Http\Controllers\Plan\CreateController::class)->name('create');
    Route::post('/store', App\Http\Controllers\Plan\StoreController::class)->name('store');
    Route::get('/update/{plan}', App\Http\Controllers\Plan\update\IndexController::class)->name('update/{plan}');
    Route::get('/update/create/{plan}', App\Http\Controllers\Plan\update\CreateController::class)->name('update/create/{plan}');
    Route::put('/update/put/', App\Http\Controllers\Plan\update\PutController::class)->name('update/put');
});
