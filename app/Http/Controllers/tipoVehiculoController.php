<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tipoVehiculo;


class tipoVehiculoController extends Controller
{
    public function index()
    {
        $tiposVehiculo = tipoVehiculo::all();
        return response()->json([
            'msg' => [
                'summary' => 'Consulta de tipos de vehículo',
                'detail' => 'Los tipos de vehículo se consultaron correctamente.',
            ],
            'data' => $tiposVehiculo
        ]);
    }

    public function show($id)
    {
        $tipoVehiculo = tipoVehiculo::find($id);
        if (!$tipoVehiculo) {
            return response()->json([
                'msg' => [
                    'summary' => 'Tipo de vehículo no encontrado',
                    'detail' => 'No se encontró el tipo de vehículo con el ID proporcionado.',
                ],
                'data' => null
            ], 404);
        }

        return response()->json([
            'msg' => [
                'summary' => 'Consulta de tipo de vehículo',
                'detail' => 'El tipo de vehículo se consultó correctamente.',
            ],
            'data' => $tipoVehiculo
        ]);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required|string',
        ]);

        // Crear el nuevo tipo de vehículo
        $tipoVehiculo = tipoVehiculo::create([
            'nombre' => $request->input('nombre'),
        ]);

        return response()->json([
            'msg' => [
                'summary' => 'Tipo de vehículo creado',
                'detail' => 'El tipo de vehículo se creó correctamente.',
            ],
            'data' => $tipoVehiculo
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $tipoVehiculo = tipoVehiculo::findOrFail($id);

        // Validación para campos opcionales
        $validatedData = $request->validate([
            'nombre' => 'sometimes|string',
        ]);

        // Actualizar solo los campos que están presentes en la solicitud
        $tipoVehiculo->update($validatedData);

        return response()->json([
            'msg' => [
                'summary' => 'Tipo de vehículo actualizado',
                'detail' => 'El tipo de vehículo se actualizó correctamente.',
            ],
            'data' => $tipoVehiculo
        ]);
    }

    public function destroy($id)
    {
        // Buscar el tipo de vehículo por su ID
        $tipoVehiculo = tipoVehiculo::findOrFail($id);

        // Eliminar el tipo de vehículo
        $tipoVehiculo->delete();

        return response()->json([
            'msg' => [
                'summary' => 'Tipo de vehículo eliminado',
                'detail' => 'El tipo de vehículo se eliminó correctamente.',
            ],
            'data' => $tipoVehiculo
        ]);
    }
}
