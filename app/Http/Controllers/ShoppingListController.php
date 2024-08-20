<?php

namespace App\Http\Controllers;

use App\Models\Grocerie;
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

    /**
     * Store a new shopping list in the database
     */
    public function addGrocerieToShoppingList(Request $request, int $listId)
    {
        try {
            $request->validate([
                'name' => 'required',
                'amount' => 'required|min:1',
                'shopping_list_id' => 'required',
            ]);

            $shoppingList = ShoppingList::find($listId);

            if ($shoppingList != null) {
                $newGrocerie = Grocerie::create([
                    'name' => $request->name,
                    'amount' => $request->amount,
                    'shopping_list_id' => $shoppingList->id,
                ]);

                $allListsGroceries = $shoppingList->groceries()->get();
                $shoppingList->groceries = $allListsGroceries;
                return response()->json([
                   $shoppingList
                ], 201);

            } else {
                return response()->json([
                    'message' => 'Shoppinglist not found'
                ], 404);
            }

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
