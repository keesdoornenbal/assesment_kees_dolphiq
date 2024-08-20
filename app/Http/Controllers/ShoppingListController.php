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
            $shoppingLists = ShoppingList::where('user_id', $request->user->id)->with('groceries')->get();

            return response()->json($shoppingLists);
        } catch (\Throwable $th) {

            // error_log($th->getMessage());
            return response()->json([
                'message' => $th->getMessage(),
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
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a new shopping list in the database
     */
    public function addGrocerieToShoppingList(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'amount' => 'required|min:1',
                'shopping_list_id' => 'required',
            ]);

            $newGrocerie = Grocerie::create([
                'name' => $request->name,
                'amount' => $request->amount,
                'shopping_list_id' => $request->shopping_list_id,
            ]);

            $shoppingList = ShoppingList::find($request->shopping_list_id);
            $groceries = Grocerie::where('shopping_list_id', $request->shopping_list_id)->get();
            $shoppingList->groceries = $groceries;

            // $shoppingList = ShoppingList::find($request->shopping_list_id)->with('groceries')->get();
            return response()->json(
                $shoppingList,
                201
            );
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified shopping list from storage.
     */
    public function destroy(Request $request, int $id)
    {
        try {

            $shoppingList = ShoppingList::find($id);
            if ($shoppingList == null) {

                return response()->json(
                    $shoppingList,
                    404
                );
            } else {
                $shoppingList->delete();

                return response()->json($shoppingList, 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified shopping list from storage.
     */
    public function change_grocery_amount(Request $request, int $id)
    {
        try {

            $request->validate([
                'amount' => 'required|min:1',
            ]);

            $grocerie = Grocerie::find($id);
            if ($grocerie == null) {

                return response()->json(
                    $grocerie,
                    404
                );
            } else {
                $grocerie->amount_to_be_purchased = $request->amount;
                $grocerie->save();

                return response()->json(
                    $grocerie,
                    200
                );
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified shopping list from storage.
     */
    public function deleteGrocerie(Request $request, int $id)
    {

        $grocerie = Grocerie::findOrFail($id);

        $grocerie->delete();

        return response()->json($grocerie, 200);
    }
}
