<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Ingredient;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $price=$this->faker->randomFloat(0, 0, 999.);
        $amount=$this->faker->randomFloat(0, 0, 999.);
        return [
            'amount' => $amount,
            'price' => $price,
            'subtotal' => $amount * $price,
            'order_id' =>  $this->faker->numberBetween(1, 10),
            'ingredient_id' => $this->faker->numberBetween(1, 50),
        ];
    }
}
