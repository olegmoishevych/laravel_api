<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

use App\DTO\ProductDTO;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    public function getAllProducts(Request $request, ProductRepository $repository): JsonResponse
    {
        $category = $request->query('category');
        $minPrice = $request->query('minPrice');
        $maxPrice = $request->query('maxPrice');

        $products = $repository->findAll($category, $minPrice, $maxPrice);

        return response()->json($products);
    }

    public function store(Request $request, ProductRepository $repository): JsonResponse
    {
        try {
            $dto = new ProductDTO(
                name: $request->input('name'),
                price: (float) $request->input('price'),
                category: $request->input('category'),
                attributes: $request->input('attributes', [])
            );

            $product = $repository->create(
                id: (string) Str::uuid(),
                dto: $dto
            );

            return response()->json($product, 201);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function show(string $id, ProductRepository $repository): JsonResponse
    {
        $product = $repository->findById($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return response()->json($product);
    }

    public function destroy(string $id, ProductRepository $repository): JsonResponse
    {
        $deleted = $repository->deleteById($id);

        if (!$deleted) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return response()->json(null, 204);
    }

    public function update(string $id, Request $request, ProductRepository $repository): JsonResponse
    {
        $data = [];

        if ($request->has('name')) {
            $data['name'] = $request->input('name');
        }

        if ($request->has('price')) {
            $data['price'] = (float) $request->input('price');
        }

        if ($request->has('category')) {
            $data['category'] = $request->input('category');
        }

        if ($request->has('attributes')) {
            $data['attributes'] = $request->input('attributes');
        }

        if (empty($data)) {
            return response()->json(['error' => 'No data provided'], 400);
        }

        $updated = $repository->updateById($id, $data);

        if (!$updated) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return response()->json(['message' => 'Product updated']);
    }
}
