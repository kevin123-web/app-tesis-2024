<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ubicacionOrigen;

class ubicacionOrigenController extends Controller
{
    public function index()
    {
        $ubicacion_origen = ubicacionOrigen::get();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta de la asignación',
                    'detail' => 'La asignación se consulto  correctamente',
                ],
                'data' => $ubicacion_origen
            ]
        );
    }

    public function show($id)
    {
        $ubicacion_origen = ubicacionOrigen::find($id);
        if (!$ubicacion_origen) {
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
            'data' => $ubicacion_origen
        ]);
    }
}
