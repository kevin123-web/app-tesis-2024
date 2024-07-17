<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ConductorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'licencia_conducir'=>$this->faker->word()->unique(),
            'hacer_user'=>false,

        ];
    }
}
