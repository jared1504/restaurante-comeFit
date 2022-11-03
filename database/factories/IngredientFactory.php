<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Ingredient;

class IngredientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ingredient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'unit' => $this->faker->randomElement(['litro', 'gramo']),
            'stock' => $this->faker->randomFloat(0, 0, 999.),
            'cost' => $this->faker->randomFloat(0, 0, 999.),
        ];
    }
}
