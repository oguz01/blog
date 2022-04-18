<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\KategoriContoller;

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




Route::get('/dashboard', function () {
    return view('admin.dashboard');
});
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('/kategori', KategoriContoller::class);
Route::resource('/post',     PostController::class);
Route::get('/post/{id}/kontrol', [PostController::class, 'kontrol']);
Route::get('/post/{id}/delete', [PostController::class, 'delete']);
Route::resource('/tag',     TagController::class);
Route::resource('/banner',     BannerController::class);



Route::get('/', [ArticleController::class, 'index']);
Route::get('/{slug}', [ArticleController::class, 'article']);
Route::get('/konu/{slug}', [ArticleController::class, 'kategori']);
Route::get('/icerik/{slug}', [ArticleController::class, 'tag']);
