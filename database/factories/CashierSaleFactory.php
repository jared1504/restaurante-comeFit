<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\CashierSale;
use App\Models\Sale;
use App\Models\User;

class CashierSaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CashierSale::class;

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
