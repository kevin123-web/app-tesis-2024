<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MiControlador extends Controller
{
    public function miMetodo()
    {
        return 'Hola mundo desde la api de Laravel';
    }
}
