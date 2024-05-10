<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tipoIntervalo;


class tipoIntervaloController extends Controller
{
    public function index()
    {
        $tipo_intervalo = tipoIntervalo::get();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta de la asignación',
                    'detail' => 'La asignación se consulto  correctamente',
                ],
                'data' => $tipo_intervalo
            ]
        );
    }

    public function show($id)
    {
        $tipo_intervalo = tipoIntervalo::find($id);
        if (!$tipo_intervalo) {
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
            'data' => $tipo_intervalo
        ]);
    }
}
