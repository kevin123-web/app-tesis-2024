<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ubicacionDestino;


class ubicacionDestinoController extends Controller
{
    public function index()
    {
        $ubicacion_destino = ubicacionDestino::get();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta de la asignación',
                    'detail' => 'La asignación se consulto  correctamente',
                ],
                'data' => $ubicacion_destino
            ]
        );
    }

    public function show($id)
    {
        $ubicacion_destino = ubicacionDestino::find($id);
        if (!$ubicacion_destino) {
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
            'data' => $ubicacion_destino
        ]);
    }
}
