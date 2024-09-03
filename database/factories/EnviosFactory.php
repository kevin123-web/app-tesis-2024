<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;


class EnviosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'descripcion'=>$this->faker->sentence(),
            'peso_mercancia' => $this->faker->randomFloat(2, 0, 800),
            'fecha_recogida' => Carbon::now(),
            'fecha_entrega' => Carbon::now(),
            'precio' => $this->faker->randomFloat(2, 0, 800),


        ];
    }
}
