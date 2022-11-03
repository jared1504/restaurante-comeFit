<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Sale;
use App\Models\Table;

class SaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sale::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status' => $this->faker->numberBetween(0, 5),
            'total' => $this->faker->randomFloat(0, 0, 9999.),
            'table_id' =>$this->faker->numberBetween(1, 20),
        ];
    }
}
