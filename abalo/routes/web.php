<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomePage;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/isloggedin', [AuthController::class, 'isLoggedIn'])->name('haslogin');
Route::get('/articles',[ArticleController::class,'index'] )->name('articles');


Route::get('/abalo',[HomePage::class,'index'] )->name('abalo');

//M2-Aufgabe9
Route::get('/newarticle',[HomePage::class,'newArticles'] )->name('articles.new');
Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
