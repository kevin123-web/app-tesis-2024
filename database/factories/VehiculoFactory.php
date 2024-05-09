<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VehiculoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'placa'=>$this->faker->word(),
            'marca'=>$this->faker->word(),
            'modelo'=>$this->faker->word(),
            'anio' => $this->faker->numberBetween(1980, 2024), 
            'tipo_contrato'=>$this->faker->word(),
            'capacidad' => $this->faker->numberBetween(1, 100), 


        ];
    }
}
