<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductApiTest extends TestCase
{
    public function test_can_create_product(): void
    {
        $response = $this->postJson('/api/products', [
            'name' => 'Test Product',
            'price' => 99.99,
            'category' => 'books',
            'attributes' => [
                'brand' => 'Test Brand',
                'color' => 'blue'
            ]
        ]);

        $response->assertStatus(201)
                 ->assertJsonFragment([
                     'name' => 'Test Product',
                     'category' => 'books'
                 ]);

        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'category' => 'books'
        ]);
    }
}
