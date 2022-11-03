<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Category;
use App\Models\Dish;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\DishController
 */
class DishControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $dishes = Dish::factory()->count(3)->create();

        $response = $this->get(route('dish.index'));

        $response->assertOk();
        $response->assertViewIs('dish.index');
        $response->assertViewHas('dishes');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('dish.create'));

        $response->assertOk();
        $response->assertViewIs('dish.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DishController::class,
            'store',
            \App\Http\Requests\DishStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $description = $this->faker->text;
        $image = $this->faker->word;
        $cost = $this->faker->randomFloat(/** double_attributes **/);
        $price = $this->faker->randomFloat(/** double_attributes **/);
        $cal = $this->faker->numberBetween(-10000, 10000);
        $category = Category::factory()->create();

        $response = $this->post(route('dish.store'), [
            'name' => $name,
            'description' => $description,
            'image' => $image,
            'cost' => $cost,
            'price' => $price,
            'cal' => $cal,
            'category_id' => $category->id,
        ]);

        $dishes = Dish::query()
            ->where('name', $name)
            ->where('description', $description)
            ->where('image', $image)
            ->where('cost', $cost)
            ->where('price', $price)
            ->where('cal', $cal)
            ->where('category_id', $category->id)
            ->get();
        $this->assertCount(1, $dishes);
        $dish = $dishes->first();

        $response->assertRedirect(route('dish.index'));
        $response->assertSessionHas('dish.id', $dish->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $dish = Dish::factory()->create();

        $response = $this->get(route('dish.show', $dish));

        $response->assertOk();
        $response->assertViewIs('dish.show');
        $response->assertViewHas('dish');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $dish = Dish::factory()->create();

        $response = $this->get(route('dish.edit', $dish));

        $response->assertOk();
        $response->assertViewIs('dish.edit');
        $response->assertViewHas('dish');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DishController::class,
            'update',
            \App\Http\Requests\DishUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $dish = Dish::factory()->create();
        $name = $this->faker->name;
        $description = $this->faker->text;
        $image = $this->faker->word;
        $cost = $this->faker->randomFloat(/** double_attributes **/);
        $price = $this->faker->randomFloat(/** double_attributes **/);
        $cal = $this->faker->numberBetween(-10000, 10000);
        $category = Category::factory()->create();

        $response = $this->put(route('dish.update', $dish), [
            'name' => $name,
            'description' => $description,
            'image' => $image,
            'cost' => $cost,
            'price' => $price,
            'cal' => $cal,
            'category_id' => $category->id,
        ]);

        $dish->refresh();

        $response->assertRedirect(route('dish.index'));
        $response->assertSessionHas('dish.id', $dish->id);

        $this->assertEquals($name, $dish->name);
        $this->assertEquals($description, $dish->description);
        $this->assertEquals($image, $dish->image);
        $this->assertEquals($cost, $dish->cost);
        $this->assertEquals($price, $dish->price);
        $this->assertEquals($cal, $dish->cal);
        $this->assertEquals($category->id, $dish->category_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $dish = Dish::factory()->create();

        $response = $this->delete(route('dish.destroy', $dish));

        $response->assertRedirect(route('dish.index'));

        $this->assertDeleted($dish);
    }
}
