<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class PersonaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            
            'nombre'=>$this->faker->word(),
            'cedula'=>Str::random(10),
            'email' => $this->faker->unique()->safeEmail(),
            'Sexo'=>$this->faker->word(),
            'direccion'=>$this->faker->word(),
            'celular'=>Str::random(10),

        ];
    }
}
