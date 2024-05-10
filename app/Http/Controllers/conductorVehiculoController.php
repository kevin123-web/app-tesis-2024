<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\conductorVehiculo;


class conductorVehiculoController extends Controller
{
    public function index()
    {
        $conductor_vehiculo = conductorVehiculo::get();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta de la asignación',
                    'detail' => 'La asignación se consulto  correctamente',
                ],
                'data' => $conductor_vehiculo
            ]
        );
    }

    public function show($id)
    {
        $conductor_vehiculo = conductorVehiculo::find($id);
        if (!$conductor_vehiculo) {
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
            'data' => $conductor_vehiculo
        ]);
    }
    
}
