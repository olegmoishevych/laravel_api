<?php

namespace App\Repositories;

use App\DTO\ProductDTO;
use Illuminate\Support\Facades\DB;

class ProductRepository
{
    public function findAll(?string $category, ?float $minPrice, ?float $maxPrice): array
    {
        $query = DB::table('products');

        if ($category) {
            $query->where('category', $category);
        }

        if ($minPrice !== null) {
            $query->where('price', '>=', $minPrice);
        }

        if ($maxPrice !== null) {
            $query->where('price', '<=', $maxPrice);
        }

        return $query->get()->map(function ($record) {
            return [
                'id' => $record->id,
                'name' => $record->name,
                'price' => (float) $record->price,
                'category' => $record->category,
                'attributes' => json_decode($record->attributes, true),
                'createdAt' => $record->created_at,
            ];
        })->toArray();
    }

    public function create(string $id, ProductDTO $dto): array
    {
        DB::table('products')->insert([
            'id' => $id,
            'name' => $dto->name,
            'price' => $dto->price,
            'category' => $dto->category,
            'attributes' => json_encode($dto->attributes),
            'created_at' => now()->toISOString()
        ]);

        return [
            'id' => $id,
            'name' => $dto->name,
            'price' => $dto->price,
            'category' => $dto->category,
            'attributes' => $dto->attributes,
            'createdAt' => now()->toISOString()
        ];
    }

    public function findById(string $id): ?array
    {
        $record = DB::table('products')->where('id', $id)->first();

        if (!$record) {
            return null;
        }

        return [
            'id' => $record->id,
            'name' => $record->name,
            'price' => (float) $record->price,
            'category' => $record->category,
            'attributes' => json_decode($record->attributes, true),
            'createdAt' => $record->created_at,
        ];
    }

    public function deleteById(string $id): bool
    {
        return DB::table('products')->where('id', $id)->delete() > 0;
    }

    public function updateById(string $id, array $data): bool
    {
        if (isset($data['attributes'])) {
            $data['attributes'] = json_encode($data['attributes']);
        }

        return DB::table('products')->where('id', $id)->update($data) > 0;
    }
}
