<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShoppingListTest extends TestCase
{

    public function test_creating_a_shopping_list(): void
    {
        $response = $this->postJson('/api/shopping-lists', ['name' => 'Sally']);

        $response
            ->assertStatus(201);
    }

    public function test_getting_all_shopping_lists(): void
    {
        $response = $this->getJson('/api/shopping-lists');

        $response
            ->assertStatus(200);
    }
}
