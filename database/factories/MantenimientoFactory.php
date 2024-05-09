<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;


class MantenimientoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fecha_mantenimiento' => Carbon::now(),
            'costo_mantenimiento' => $this->faker->randomFloat(2, 0, 800),
            'intervalo_numero' => $this->faker->numberBetween(1, 100), 
        ];
    }
}
