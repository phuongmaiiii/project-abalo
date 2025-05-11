<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ShoppingCartController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//M3-Aufgabe7
Route::get('/articles', [ArticleController::class, 'search']);
//M3-Aufgabe8
Route::post('/articles', [ArticleController::class, 'store2']);

//M3-Aufgabe10
Route::post('/shoppingcart', [ShoppingCartController::class, 'addArticle']);
Route::delete('/shoppingcart/{shoppingcartid}/articles/{articleid}', [ShoppingCartController::class, 'removeArticle']);
Route::get('/shoppingcart', [ShoppingCartController::class, 'getCart']);
