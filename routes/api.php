<?php

use App\Http\Controllers\ShoppingListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::resource('shopping-lists', ShoppingListController::class);
Route::post('/shopping-lists/add-grocerie', [ShoppingListController::class, 'addGrocerieToShoppingList']);
Route::put('/shopping-lists/change-grocerie/{id}', [ShoppingListController::class, 'changeGroceryAmount']);
Route::put('/shopping-lists/delete-grocerie/{id}', [ShoppingListController::class, 'deleteGrocerie']);