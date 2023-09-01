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
Route::prefix('/plans')->group(function() {
    // 新規に登録
    Route::get('/', App\Http\Controllers\Plan\IndexController::class)->name('home');
    Route::get('/create', App\Http\Controllers\Plan\CreateController::class)->name('create');
    Route::post('/store', App\Http\Controllers\Plan\StoreController::class)->name('store');

    // 検索機能
    Route::get('/search', App\Http\Controllers\Plan\SearchController::class)->name('search');

    // 登録したものを編集
    Route::get('/update/{plan}', App\Http\Controllers\Plan\update\IndexController::class)->name('update/{plan}');
    Route::get('/update/create/{plan}', App\Http\Controllers\Plan\update\CreateController::class)->name('update/create/{plan}');
    Route::put('/update/put/', App\Http\Controllers\Plan\update\PutController::class)->name('update/put');
    Route::delete('/update/delete/{plan}/', App\Http\Controllers\Plan\update\DeleteController::class)->name('update/delete/{plan}');

    // 投稿するときの処理
    Route::put('status/put/{plan}/', App\Http\Controllers\Plan\status\putController::class)->name('status/put/{plan}');

    // 投稿されたものを表示
    Route::get('/share', App\Http\Controllers\Plan\share\IndexController::class)->name('share');
    Route::get('/share/detail/{plan}', App\Http\Controllers\Plan\share\PlanDetailController::class)->name('share/detail/{plan}');

    // いいねした投稿を表示
    Route::get('/like', App\Http\Controllers\Plan\share\LikeIndexController::class)->name('like');

    // 投稿がいいねされたとき
    Route::post('/share/like', App\Http\Controllers\Plan\share\LikeController::class)->name('share/like');
});


