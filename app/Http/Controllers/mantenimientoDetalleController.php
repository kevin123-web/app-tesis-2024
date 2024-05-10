<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mantenimientoDetalle;


class mantenimientoDetalleController extends Controller
{
    public function index()
    {
        $mantenimiento_detalle = mantenimientoDetalle::get();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta de la asignación',
                    'detail' => 'La asignación se consulto  correctamente',
                ],
                'data' => $mantenimiento_detalle
            ]
        );
    }

    public function show($id)
    {
        $mantenimiento_detalle = mantenimientoDetalle::find($id);
        if (!$mantenimiento_detalle) {
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
            'data' => $mantenimiento_detalle
        ]);
    }
}
