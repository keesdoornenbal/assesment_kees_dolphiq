<?php

namespace App\Http\Controllers;

use App\Models\ShoppingList;
use Illuminate\Http\Request;

class ShoppingListController extends Controller
{
    /**
     * Should show all the shopping lists in the database.
     */
    public function index(Request $request)
    {
        try {
            $shoppingLists = ShoppingList::get();
            return response()->json($shoppingLists);
        } catch (\Throwable $th) {

            // error_log($th->getMessage());
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Store a new shopping list in the database
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
            ]);

            $newShoppingList = ShoppingList::create([
                'name' => $request->name,
            ]);

            return response()->json($newShoppingList, 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
