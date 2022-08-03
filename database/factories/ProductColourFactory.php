<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductColourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'colour' => $this->faker->word(),
            'stock_quantity' => $this->faker->randomNumber(2),
        ];
    }
}
