<?php

namespace Database\Factories;
use Carbon\Carbon;


use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'fecha_registro' => Carbon::now(),
            'tipo_cliente'=>$this->faker->word(),
            
        ];
    }
}
