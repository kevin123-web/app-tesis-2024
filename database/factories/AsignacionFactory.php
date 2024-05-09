<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;


class AsignacionFactory extends Factory
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
        ];
    }
}
