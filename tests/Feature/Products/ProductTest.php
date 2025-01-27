<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{

    public function test_products_can_be_indexed() {
        $response = $this->get('/api/products');
        $response->assertStatus(200);
    }

    public function test_product_can_be_shown() {
        $product = Product::factory()->create();
        $product->save();

        $response = $this->get('/api/products/' . $product->id);
        $response->assertStatus(200);
    }

    public function test_product_can_be_stored() {
        $product = Product::factory()->create();
        $response = $this->postJson('/api/products/', [
            'sku' => $product->sku,
            'name' => $product->name,
            'price' => $product->price
        ]);
        $response->assertStatus(200);
    }

    public function test_product_can_be_updated() {
        $id = Product::all()->first()->getKey();
        $product = Product::factory()->create();
        $response = $this->putJson('/api/products/' . $id, [
            'sku' => $product->sku,
            'name' => $product->name,
            'price' => $product->price
        ]);
        $response->assertStatus(200);
    }

    public function test_product_can_be_destroyed() {
        $id = Product::all()->first()->getKey();
        $response = $this->delete('/api/products/'. $id);
        $response->assertStatus(200);
    }
}
