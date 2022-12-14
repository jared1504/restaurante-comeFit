<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Dish;

class DishFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Dish::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->text,
            'image' => 'dish.jpg',
            'cost' => $this->faker->randomFloat(0, 0, 999.),
            'price' => $this->faker->randomFloat(0, 0, 999.),
            'cal' => $this->faker->numberBetween(0, 1000),
            'category_id' => $this->faker->numberBetween(1, 5),
        ];
    }
}
