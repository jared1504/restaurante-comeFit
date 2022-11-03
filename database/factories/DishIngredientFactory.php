<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Dish;
use App\Models\DishIngredient;
use App\Models\Ingredient;

class DishIngredientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DishIngredient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amount' => $this->faker->randomFloat(0, 0, 999.),
            'dish_id' =>$this->faker->numberBetween(1, 50),
            'ingredient_id' =>$this->faker->numberBetween(1, 50),
        ];
    }
}
