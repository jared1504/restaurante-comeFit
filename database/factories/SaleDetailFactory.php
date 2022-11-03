<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Dish;
use App\Models\Sale;
use App\Models\SaleDetail;

class SaleDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SaleDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status' => $this->faker->numberBetween(1, 5),
            'amount' => $this->faker->randomFloat(0, 0, 999.),
            'price' => $this->faker->randomFloat(0, 0, 99.),
            'subtotal' => $this->faker->randomFloat(0, 0, 9999.),
            'dish_id'  =>$this->faker->numberBetween(1, 50),
            'sale_id'  =>$this->faker->numberBetween(1, 50),
        ];
    }
}
