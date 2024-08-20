<?php

namespace Tests\Feature;

use App\Models\Grocerie;
use App\Models\ShoppingList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ShoppingListTest extends TestCase
{


    public function test_creating_a_shopping_list(): void
    {
        $response = $this->postJson('/api/shopping-lists', ['name' => 'Test Shopping List']);

        $response
            ->assertStatus(201)
            ->assertJson([
                'name' => true,
                'updated_at' => true,
                'created_at' => true,
                'id' => true,
            ]);
    }

    public function test_getting_all_shopping_lists(): void
    {
        $response = $this->getJson('/api/shopping-lists');

        $response
            ->assertStatus(200);
    }

    public function test_adding_grocerie_item_to_list(): void
    {
        $latestShoppingList = ShoppingList::firstWhere('name', 'Test Shopping List');
        $response = $this->postJson('/api/shopping-lists/add-grocerie', ['name' => 'TestGrocerie', "amount" => 4, "shopping_list_id" => $latestShoppingList->id]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'name' => true,
                'groceries' => true,
                'created_at' => true,
                'id' => true,
            ]);
    }

    public function test_changing_grocerie_item_amount(): void
    {
        $latestGrocerie = Grocerie::where('name', 'TestGrocerie')->first();

        $latestGrocerieId = $latestGrocerie->id;
        $latestGrocerie->dd();
        $response = $this->putJson("/shopping-lists/change-grocerie/$latestGrocerieId", ["amount" => 15]);

        $response
            ->assertStatus(201)
            ->assertJson([[
                'name' => true,
                'groceries' => true,
                'created_at' => true,
                'id' => true,
            ]]);
    }

    public function test_removing_grocerie_item(): void
    {
        $latestGrocerie = Grocerie::firstWhere('name', 'TestGrocerie');
        $response = $this->deleteJson("/shopping-lists/change-grocerie/$latestGrocerie->id");

        $response
            ->assertStatus(200);
    }

    public function test_deleting_last_shopping_list(): void
    {
        $latestShoppingList = ShoppingList::firstWhere('name', 'Test Shopping List');
        $response = $this->deleteJson("/api/shopping-lists/$latestShoppingList->id");

        $response
            ->assertStatus(200);
    }
}
