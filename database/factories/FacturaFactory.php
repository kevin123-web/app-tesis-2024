<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;


class FacturaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'fecha' => Carbon::now(),
            'sub_total' => $this->faker->randomFloat(2, 0, 800),
            'total' => $this->faker->randomFloat(2, 0, 800),
            'con_iva'=>false,
            'servicio'=>false,

        ];
    }
}
