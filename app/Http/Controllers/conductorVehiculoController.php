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
    
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'conductor_id' => 'required|integer|exists:conductor,id',
            'vehiculo_id' => 'required|integer|exists:vehiculo,id',
        ]);

        // Crear la nueva asignación
        $conductor_vehiculo = conductorVehiculo::create([
            'conductor_id' => $request->input('conductor_id'),
            'vehiculo_id' => $request->input('vehiculo_id'),
        ]);

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Asignación creada',
                'detail' => 'La asignación se creó correctamente',
            ],
            'data' => $conductor_vehiculo
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $conductor_vehiculo = conductorVehiculo::findOrFail($id);

        // Validación para todos los campos, pero permitiendo que algunos sean opcionales
        $validatedData = $request->validate([
            'conductor_id' => 'sometimes|integer|exists:conductor,id',
            'vehiculo_id' => 'sometimes|integer|exists:vehiculo,id',
        ]);

        // Actualizar solo los campos que están presentes en la solicitud
        $conductor_vehiculo->update($validatedData);

        return response()->json([
            'msg' => [
                'summary' => 'Actualización de la asignación',
                'detail' => 'La asignación se actualizó correctamente',
            ],
            'data' => $conductor_vehiculo
        ]);
    }

    public function destroy($id)
    {
        // Buscar la asignación por su ID
        $conductor_vehiculo = conductorVehiculo::findOrFail($id);

        // Eliminar la asignación
        $conductor_vehiculo->delete();

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Asignación eliminada',
                'detail' => 'La asignación se eliminó correctamente',
            ],
            'data' => $conductor_vehiculo
        ]);
    }
}
