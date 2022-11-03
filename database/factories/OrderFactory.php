<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\Supplier;
use App\Models\User;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'total' => $this->faker->randomFloat(0, 0, 9999999999.),
            'supplier_id' => $this->faker->numberBetween(1, 5),
            'user_id' =>  $this->faker->numberBetween(1, 10),
        ];
    
    }
}
