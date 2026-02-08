<?php

use App\Http\Controllers\LandingController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [LandingController::class, 'index'])->name('landing');

// semua berita
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
// berita per category
Route::get('/{slug}', [NewsController::class, 'category'])->name('news.category');
// detail  news
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');
