<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @throws Exception
     */
    public function index(): JsonResponse
    {
        try {
            $products = $this->productService->getAllProducts();
            Log::info('Fetched all products from controller.');
            return response()->json($products);
        } catch (Exception $exception) {
            Log::error('Error fetching products: ' . $exception->getMessage());
            return response()->json(['error' => 'Unable to fetch products'], 500);
        }
    }

    /**
     * @throws Exception
     */
    public function show(int $id): JsonResponse
    {
        try {
            $product = $this->productService->getProductById($id);
            Log::info("Fetched product by ID: {$id}");
            return response()->json($product);
        } catch (Exception $exception) {
            Log::error("Error fetching product ID {$id}: " . $exception->getMessage());
            return response()->json(['error' => 'Product not found'], 404);
        }
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $product = $this->productService->createProduct($data);
            Log::info('Stored a new product.', ['product' => $product]);
            return response()->json($product, 201);
        } catch (Exception $exception) {
            Log::error('Error storing product: ' . $exception->getMessage());
            return response()->json(['error' => 'Unable to store product'], 500);
        }
    }

    /**
     * @throws Exception
     */
    public function edit(int $id): JsonResponse
    {
        try {
            $product = $this->productService->getProductById($id);
            Log::info("Fetched product for editing by ID: {$id}");
            return response()->json($product);
        } catch (Exception $exception) {
            Log::error("Error fetching product for edit ID {$id}: " . $exception->getMessage());
            return response()->json(['error' => 'Product not found'], 404);
        }
    }

    public function update(UpdateProductRequest $request, int $id): JsonResponse
    {
        try {
            $data = $request->validated();
            $product = $this->productService->updateProduct($id, $data);
            Log::info("Updated product ID: {$id}", ['product' => $product]);
            return response()->json($product);
        } catch (Exception $exception) {
            Log::error("Error updating product ID {$id}: " . $exception->getMessage());
            return response()->json(['error' => 'Unable to update product'], 500);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->productService->deleteProduct($id);
            Log::info("Deleted product ID: {$id}");
            return response()->json(['message' => 'Product deleted successfully'], 204);
        } catch (Exception $exception) {
            Log::error("Error deleting product ID {$id}: " . $exception->getMessage());
            return response()->json(['error' => 'Unable to delete product'], 500);
        }
    }
}
