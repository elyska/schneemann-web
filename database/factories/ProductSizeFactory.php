<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductSizeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'size' => $this->faker->randomElement(['S', 'M', 'L']),
            'stock_quantity' => $this->faker->randomNumber(2),
        ];
    }
}
