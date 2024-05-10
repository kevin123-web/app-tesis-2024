<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tipoMantenimiento;


class tipoMantenimientoController extends Controller
{
    public function index()
    {
        $tipo_mantenimiento = tipoMantenimiento::get();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta de la asignación',
                    'detail' => 'La asignación se consulto  correctamente',
                ],
                'data' => $tipo_mantenimiento
            ]
        );
    }

    public function show($id)
    {
        $tipo_mantenimiento = tipoMantenimiento::find($id);
        if (!$tipo_mantenimiento) {
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
            'data' => $tipo_mantenimiento
        ]);
    }
}
