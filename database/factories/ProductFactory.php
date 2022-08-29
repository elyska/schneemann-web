<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title_cz' => $this->faker->name(),
            'title_en' => $this->faker->name(),
            'url' => $this->faker->unique()->word(),
            'price' => $this->faker->randomFloat(2, 1, 20),
            'weight' => $this->faker->randomFloat(2, 0.1, 1),
            'description_cz' => $this->faker->text(),
            'description_en' => $this->faker->text(),
            'stock_quantity' => $this->faker->randomNumber(2),
        ];
    }
}
