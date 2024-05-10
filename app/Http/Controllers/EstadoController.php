<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estado;

class EstadoController extends Controller
{
    public function index()
    {
        $estados = Estado::get();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta del estado',
                    'detail' => 'El estado se consulto  correctamente',
                ],
                'data' => $estados
            ]
        );
    }

    public function show($id)
    {
        $estados = Estado::find($id);
        if (!$estados) {
            return response()->json([
                'msg' => [
                    'summary' => 'Estado no encontrado',
                    'detail' => 'El estado con el ID proporcionado no fue encontrado',
                ],
                'data' => null
            ], 404);
        }
    
        return response()->json([
            'msg' => [
                'summary' => 'Consulta de estado',
                'detail' => 'El estado se consultó correctamente',
            ],
            'data' => $estados
        ]);
    }
    
}
