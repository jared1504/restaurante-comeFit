<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProductController
 */
class ProductControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $products = Product::factory()->count(3)->create();

        $response = $this->get(route('product.index'));

        $response->assertOk();
        $response->assertViewIs('product.index');
        $response->assertViewHas('products');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('product.create'));

        $response->assertOk();
        $response->assertViewIs('product.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProductController::class,
            'store',
            \App\Http\Requests\ProductStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $category = Category::factory()->create();
        $supplier = Supplier::factory()->create();
        $price = $this->faker->randomFloat(/** decimal_attributes **/);
        $stock = $this->faker->randomFloat(/** decimal_attributes **/);
        $slug = $this->faker->slug;
        $presentation = $this->faker->word;
        $brand = $this->faker->word;
        $url_photo = $this->faker->word;
        $content = $this->faker->paragraphs(3, true);

        $response = $this->post(route('product.store'), [
            'name' => $name,
            'category_id' => $category->id,
            'supplier_id' => $supplier->id,
            'price' => $price,
            'stock' => $stock,
            'slug' => $slug,
            'presentation' => $presentation,
            'brand' => $brand,
            'url_photo' => $url_photo,
            'content' => $content,
        ]);

        $products = Product::query()
            ->where('name', $name)
            ->where('category_id', $category->id)
            ->where('supplier_id', $supplier->id)
            ->where('price', $price)
            ->where('stock', $stock)
            ->where('slug', $slug)
            ->where('presentation', $presentation)
            ->where('brand', $brand)
            ->where('url_photo', $url_photo)
            ->where('content', $content)
            ->get();
        $this->assertCount(1, $products);
        $product = $products->first();

        $response->assertRedirect(route('product.index'));
        $response->assertSessionHas('product.id', $product->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $product = Product::factory()->create();

        $response = $this->get(route('product.show', $product));

        $response->assertOk();
        $response->assertViewIs('product.show');
        $response->assertViewHas('product');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $product = Product::factory()->create();

        $response = $this->get(route('product.edit', $product));

        $response->assertOk();
        $response->assertViewIs('product.edit');
        $response->assertViewHas('product');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProductController::class,
            'update',
            \App\Http\Requests\ProductUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $product = Product::factory()->create();
        $name = $this->faker->name;
        $category = Category::factory()->create();
        $supplier = Supplier::factory()->create();
        $price = $this->faker->randomFloat(/** decimal_attributes **/);
        $stock = $this->faker->randomFloat(/** decimal_attributes **/);
        $slug = $this->faker->slug;
        $presentation = $this->faker->word;
        $brand = $this->faker->word;
        $url_photo = $this->faker->word;
        $content = $this->faker->paragraphs(3, true);

        $response = $this->put(route('product.update', $product), [
            'name' => $name,
            'category_id' => $category->id,
            'supplier_id' => $supplier->id,
            'price' => $price,
            'stock' => $stock,
            'slug' => $slug,
            'presentation' => $presentation,
            'brand' => $brand,
            'url_photo' => $url_photo,
            'content' => $content,
        ]);

        $product->refresh();

        $response->assertRedirect(route('product.index'));
        $response->assertSessionHas('product.id', $product->id);

        $this->assertEquals($name, $product->name);
        $this->assertEquals($category->id, $product->category_id);
        $this->assertEquals($supplier->id, $product->supplier_id);
        $this->assertEquals($price, $product->price);
        $this->assertEquals($stock, $product->stock);
        $this->assertEquals($slug, $product->slug);
        $this->assertEquals($presentation, $product->presentation);
        $this->assertEquals($brand, $product->brand);
        $this->assertEquals($url_photo, $product->url_photo);
        $this->assertEquals($content, $product->content);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $product = Product::factory()->create();

        $response = $this->delete(route('product.destroy', $product));

        $response->assertRedirect(route('product.index'));

        $this->assertDeleted($product);
    }
}
