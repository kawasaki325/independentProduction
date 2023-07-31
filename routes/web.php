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
Route::prefix('planes')->group(function() {
    Route::get('/', App\Http\Controllers\Plane\IndexController::class)->name('planes');
    Route::get('/create', App\Http\Controllers\Plane\CreateController::class)->name('planes/create');
    Route::post('/create', App\Http\Controllers\Plane\StoreController::class)->name('planes/create');
});
