<?php

namespace App\Services;

use App\Contracts\ProductRepositoryInterface;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Log;

class ProductService
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @throws Exception
     */
    public function getAllProducts(): array
    {
        $products = $this->productRepository->all()->toArray();

        if (empty($products)) {
            Log::warning('No products found in the database.');
            throw new Exception("No products found in the database.");
        }

        Log::info('Fetched all products.', ['count' => count($products)]);
        return $products;
    }

    /**
     * @throws Exception
     */
    public function getProductById(int $id): ?Product
    {
        $product = $this->productRepository->find($id);

        if (!$product) {
            Log::error("Product not found for ID: {$id}");
            throw new Exception("Product not found.");
        }

        Log::info("Fetched product by ID: {$id}", ['product' => $product]);
        return $product;
    }

    public function createProduct(array $data): Product
    {
        $product = $this->productRepository->create($data);
        Log::info('Created new product.', ['product' => $product]);
        return $product;
    }

    public function updateProduct(int $id, array $data): ?Product
    {
        $product = $this->productRepository->update($id, $data);
        Log::info("Updated product ID: {$id}", ['product' => $product]);
        return $product;
    }

    public function deleteProduct(int $id): void
    {
        $this->productRepository->delete($id);
        Log::info("Deleted product ID: {$id}");
    }
}
