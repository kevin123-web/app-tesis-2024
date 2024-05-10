<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tipoPago;


class tipoPagoController extends Controller
{
    public function index()
    {
        $tipo_pago = tipoPago::get();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta de la asignación',
                    'detail' => 'La asignación se consulto  correctamente',
                ],
                'data' => $tipo_pago
            ]
        );
    }

    public function show($id)
    {
        $tipo_pago = tipoPago::find($id);
        if (!$tipo_pago) {
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
            'data' => $tipo_pago
        ]);
    }
}
