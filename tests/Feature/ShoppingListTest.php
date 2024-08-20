<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ShoppingListTest extends TestCase
{

    public function test_creating_a_shopping_list(): void
    {
        $response = $this->postJson('/api/shopping-lists', ['name' => 'Sally']);

        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);
    }

    public function test_getting_all_shopping_lists(): void
    {
        $response = $this->getJson('/api/shopping-lists');

        $response
            ->assertStatus(200);

        // $response
        //     ->assertJson(
        //         fn(AssertableJson $json) =>
        //         $json->has(1)

        //     );
    }
}
