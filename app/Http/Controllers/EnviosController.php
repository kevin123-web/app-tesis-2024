<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Envios;


class EnviosController extends Controller
{
    public function index()
    {
        $envio = Envios::get();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta de la asignación',
                    'detail' => 'La asignación se consulto  correctamente',
                ],
                'data' => $envio
            ]
        );
    }

    public function show($id)
    {
        $envio = Envios::find($id);
        if (!$envio) {
            return response()->json([
                'msg' => [
                    'summary' => 'Asignación no encontrada',
                    'detail' => ' La asignación con el ID proporcionado no fue encontrado',
                ],
                'data' => null
            ], 404);
        }
    
        return response()->json([
            'msg' => [
                'summary' => 'Consulta de la asignación',
                'detail' => 'La asignación se consulto  correctamente',
            ],
            'data' => $envio
        ]);
    }
}
