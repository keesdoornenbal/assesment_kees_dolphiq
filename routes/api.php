<?php

use App\Http\Controllers\ShoppingListController;
use Illuminate\Support\Facades\Route;

Route::get('/shopping-lists', [ShoppingListController::class, 'index']);
Route::post('/shopping-lists', [ShoppingListController::class, 'store']);
Route::delete('/shopping-lists', [ShoppingListController::class, 'destroy']);
Route::post('/shopping-lists/add-grocerie', [ShoppingListController::class, 'addGrocerieToShoppingList']);
Route::put('/shopping-lists/change-grocerie/{id}', [ShoppingListController::class, 'changeGroceryAmount']);
Route::delete('/shopping-lists/delete-grocerie/{id}', [ShoppingListController::class, 'deleteGrocerie']);
