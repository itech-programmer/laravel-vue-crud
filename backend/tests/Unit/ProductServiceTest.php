<?php

namespace Tests\Unit;

use App\Services\ProductService;
use App\Contracts\ProductRepositoryInterface;
use App\Models\Product;
use Exception;
use PHPUnit\Framework\TestCase;
use Mockery;

class ProductServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
    }

    public function testGetAllProducts()
    {
        $repositoryMock = Mockery::mock(ProductRepositoryInterface::class);

        $product = new Product();
        $product->name = 'Test Product';
        $product->description = 'Description';
        $product->price = 100;

        $repositoryMock->shouldReceive('all')->once()->andReturn(collect([$product]));

        $service = new ProductService($repositoryMock);
        $products = $service->getAllProducts();

        $this->assertIsArray($products);
        $this->assertNotEmpty($products);
        $this->assertEquals('Test Product', $products[0]['name']);
    }


    /**
     * @throws Exception
     */
    public function testGetProductById()
    {
        $repositoryMock = Mockery::mock(ProductRepositoryInterface::class);
        $product = new Product(/* параметры продукта */);
        $repositoryMock->shouldReceive('find')->with(1)->once()->andReturn($product);

        $service = new ProductService($repositoryMock);
        $result = $service->getProductById(1);

        $this->assertNotNull($result);
        $this->assertInstanceOf(Product::class, $result);
    }

    public function testCreateProduct()
    {
        $data = ['name' => 'Test Product', 'description' => 'Description', 'price' => 100];
        $repositoryMock = Mockery::mock(ProductRepositoryInterface::class);
        $product = new Product(/* параметры продукта */);
        $repositoryMock->shouldReceive('create')->with($data)->once()->andReturn($product);

        $service = new ProductService($repositoryMock);
        $result = $service->createProduct($data);

        $this->assertNotNull($result);
        $this->assertInstanceOf(Product::class, $result);
    }

    public function testUpdateProduct()
    {
        $data = ['name' => 'Updated Product', 'description' => 'Updated Description', 'price' => 150];
        $repositoryMock = Mockery::mock(ProductRepositoryInterface::class);
        $product = new Product(/* параметры продукта */);
        $repositoryMock->shouldReceive('update')->with(1, $data)->once()->andReturn($product);

        $service = new ProductService($repositoryMock);
        $result = $service->updateProduct(1, $data);

        $this->assertNotNull($result);
        $this->assertInstanceOf(Product::class, $result);
    }

    public function testDeleteProduct()
    {
        $repositoryMock = Mockery::mock(ProductRepositoryInterface::class);
        $repositoryMock->shouldReceive('delete')->with(1)->once()->andReturn(true);

        $service = new ProductService($repositoryMock);
        $this->expectNotToPerformAssertions();
        $service->deleteProduct(1);
    }

    public function testGetProductByIdNotFound()
    {
        $this->expectException(Exception::class);

        $repositoryMock = Mockery::mock(ProductRepositoryInterface::class);
        $repositoryMock->shouldReceive('find')->with(1)->once()->andReturn(null);

        $service = new ProductService($repositoryMock);
        $service->getProductById(1);
    }
}
