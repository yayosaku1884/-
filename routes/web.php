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
    //一覧画面の表示//
    Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);
    //登録画面の表示//
    Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);
    //登録処理//
    Route::post('/add', [App\Http\Controllers\ItemController::class, 'add']);
    //詳細画面
    Route::get('/show/{id}', [App\Http\Controllers\ItemController::class, 'show'])->name('show');
    //編集画面//
    Route::get('/edit/{id}', [App\Http\Controllers\ItemController::class, 'edit'])->name('edit');
    //更新処理//
    Route::post('/update/{id}', [App\Http\Controllers\ItemController::class, 'update'])->name('update');
    //削除処理//
    Route::post('/destroy{id}', [App\Http\Controllers\ItemController::class, 'destroy'])->name('destroy');

});