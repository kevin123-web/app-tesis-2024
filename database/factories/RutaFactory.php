<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RutaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tiempo_estimado'=>Str::random(10),
            'distancia' => $this->faker->numberBetween(0, 100), 

        ];
    }
}
