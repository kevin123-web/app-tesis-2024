<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estado;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Estado::factory(10)->create();
    }
}
