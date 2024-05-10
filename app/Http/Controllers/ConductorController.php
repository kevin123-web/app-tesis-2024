<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conductor;


class ConductorController extends Controller
{
    public function index()
    {
        $conductores = Conductor::get();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta de la asignación',
                    'detail' => 'La asignación se consulto  correctamente',
                ],
                'data' => $conductores
            ]
        );
    }

    public function show($id)
    {
        $conductores = Conductor::find($id);
        if (!$conductores) {
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
            'data' => $conductores
        ]);
    }
}
