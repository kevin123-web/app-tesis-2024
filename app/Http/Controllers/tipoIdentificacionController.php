<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tipoIdentificacion;


class tipoIdentificacionController extends Controller
{
    public function index()
    {
        $tipo_identificacion = tipoIdentificacion::get();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta de la asignación',
                    'detail' => 'La asignación se consulto  correctamente',
                ],
                'data' => $tipo_identificacion
            ]
        );
    }

    public function show($id)
    {
        $tipo_identificacion = tipoIdentificacion::find($id);
        if (!$tipo_identificacion) {
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
            'data' => $tipo_identificacion
        ]);
    }
}
