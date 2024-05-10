<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Factura;


class FacturaController extends Controller
{
    public function index()
    {
        $facturas = Factura::get();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta de la asignación',
                    'detail' => 'La asignación se consulto  correctamente',
                ],
                'data' => $facturas
            ]
        );
    }

    public function show($id)
    {
        $facturas = Factura::find($id);
        if (!$facturas) {
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
            'data' => $facturas
        ]);
    }
}
