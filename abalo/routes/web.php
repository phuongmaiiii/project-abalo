<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomePage;
use App\Http\Controllers\MessageController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/isloggedin', [AuthController::class, 'isLoggedIn'])->name('haslogin');
Route::get('/articles',[ArticleController::class,'index'] )->name('articles');


Route::get('/abalo',[HomePage::class,'index'] )->name('abalo');

//M2-Aufgabe9
Route::view('/newarticle', 'articles.newarticle')->name('newarticle');
Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');

//M3-Aufgabe1
Route::get('/ajax1', [MessageController::class, 'viewStatic'])->name('ajax1');
Route::get('/ajax2', [MessageController::class, 'viewPeriodic'])->name('ajax2');
Route::get('/api/message', [MessageController::class, 'getMessage'])->name('api.message');

//M3-Aufgabe3-4
Route::get('/api/categories', [HomePage::class, 'getCategories'])->name('api.categories');
