<?php

namespace Tests\Unit;

use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Services\ProductService;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mockery;

class ProductControllerTest extends TestCase
{
    use WithFaker;

    protected function tearDown(): void
    {
        Mockery::close();
    }

    public function testIndex()
    {
        $serviceMock = Mockery::mock(ProductService::class);
        $serviceMock->shouldReceive('getAllProducts')->once()->andReturn([]);

        $controller = new ProductController($serviceMock);
        $response = $controller->index();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testShow()
    {
        $serviceMock = Mockery::mock(ProductService::class);
        $serviceMock->shouldReceive('getProductById')->with(1)->once()->andReturn(/* объект продукта */);

        $controller = new ProductController($serviceMock);
        $response = $controller->show(1);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testStore()
    {
        $data = ['name' => 'Test Product', 'description' => 'Description', 'price' => 100];
        $requestMock = Mockery::mock(StoreProductRequest::class);
        $requestMock->shouldReceive('validated')->once()->andReturn($data);

        $productMock = new Product($data);

        $serviceMock = Mockery::mock(ProductService::class);
        $serviceMock->shouldReceive('createProduct')->with($data)->once()->andReturn($productMock);

        $controller = new ProductController($serviceMock);
        $response = $controller->store($requestMock);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(201, $response->getStatusCode());
    }

    public function testUpdate()
    {
        $data = ['name' => 'Updated Product', 'description' => 'Updated Description', 'price' => 150];
        $requestMock = Mockery::mock(UpdateProductRequest::class);
        $requestMock->shouldReceive('validated')->once()->andReturn($data);

        $serviceMock = Mockery::mock(ProductService::class);
        $serviceMock->shouldReceive('updateProduct')->with(1, $data)->once()->andReturn(/* объект обновленного продукта */);

        $controller = new ProductController($serviceMock);
        $response = $controller->update($requestMock, 1);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testDestroy()
    {
        $serviceMock = Mockery::mock(ProductService::class);
        $serviceMock->shouldReceive('deleteProduct')->with(1)->once();

        $controller = new ProductController($serviceMock);
        $response = $controller->destroy(1);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(204, $response->getStatusCode());
    }
}
