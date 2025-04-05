<?php

namespace Tests\Unit;

use App\DTO\ProductDTO;
use App\Repositories\ProductRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Str;

class ProductRepositoryTest extends TestCase
{
    protected ProductRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new ProductRepository();
    }

    public function test_can_create_product(): void
    {
        $dto = new ProductDTO(
            name: 'Unit Test Product',
            price: 49.99,
            category: 'test',
            attributes: ['a' => 1]
        );

        $id = (string) Str::uuid();
        $product = $this->repository->create($id, $dto);

        $this->assertEquals($id, $product['id']);
        $this->assertDatabaseHas('products', ['id' => $id]);
    }

    public function test_can_find_product_by_id(): void
    {
        $dto = new ProductDTO(
            name: 'Find Me',
            price: 100,
            category: 'search',
            attributes: ['key' => 'value']
        );

        $id = (string) Str::uuid();
        $this->repository->create($id, $dto);

        $found = $this->repository->findById($id);

        $this->assertNotNull($found);
        $this->assertEquals('Find Me', $found['name']);
    }
}
