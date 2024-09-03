<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TarifaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'valor' => $this->faker->randomFloat(2, 0, 800),
        ];
    }
}
