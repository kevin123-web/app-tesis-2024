<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre_usuario'=>$this->faker->word(),
            'nombre'=>$this->faker->word(),
            'email' => $this->faker->unique()->safeEmail(),
            'contraseña'=>$this->faker->sentence(),

        ];
    }
}
