<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tipoVehiculo;


class tipoVehiculoController extends Controller
{
    public function index()
    {
        $tipo_vehiculo = tipoVehiculo::get();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta de la asignación',
                    'detail' => 'La asignación se consulto  correctamente',
                ],
                'data' => $tipo_vehiculo
            ]
        );
    }

    public function show($id)
    {
        $tipo_vehiculo = tipoVehiculo::find($id);
        if (!$tipo_vehiculo) {
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
            'data' => $tipo_vehiculo
        ]);
    }
}
