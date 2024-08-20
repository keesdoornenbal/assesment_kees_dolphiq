<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShoppingListTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->getJson('/shopping-lists');

        // $response->assertJson(
        //     fn(AssertableJson $json) =>
        //     $json->has('status')
        //         ->hasAny('data', 'message', 'code')
        // );

        $response->assertStatus(200);
    }
}
