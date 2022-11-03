<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Sale;
use App\Models\User;
use App\Models\WaiterSale;

class WaiterSaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WaiterSale::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sale_id' =>$this->faker->numberBetween(1, 50),
            'user_id' =>$this->faker->numberBetween(1, 10),
        ];
    }
}
