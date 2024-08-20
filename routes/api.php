<?php

use App\Http\Controllers\ShoppingListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


// Route::res('/shopping-list', [ShoppingListController::class]);
Route::resource('shopping-lists', ShoppingListController::class);