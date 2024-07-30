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
                    'summary' => 'Lista de asignaciones de vehículos',
                    'detail' => 'Se consultaron las asignaciones de vehículos correctamente.',
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
                    'summary' => 'Asignación de vehículo no encontrada',
                    'detail' => 'No se encontró una asignación de vehículo con el ID proporcionado.',
                ],
                'data' => null
            ], 404);
        }
    
        return response()->json([
            'msg' => [
                'summary' => 'Detalles de la asignación de vehículo',
                'detail' => 'Se consultaron los detalles de la asignación de vehículo correctamente.',
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
                'summary' => 'Asignación de vehículo creada',
                'detail' => 'La asignación de vehículo se creó correctamente.',
            ],
            'data' => $conductor_vehiculo
        ], 201);
    }

    public function update(Request $request, $id)
    {
        // Buscar el registro por ID
        $conductorVehiculo = conductorVehiculo::findOrFail($id);
    
        // Validación para todos los campos, permitiendo que algunos sean opcionales
        $validatedData = $request->validate([
            'conductor_id' => 'sometimes|integer|exists:conductor,id',
            'vehiculo_id' => 'sometimes|integer|exists:vehiculo,id',
        ]);
    
        // Actualizar solo los campos que están presentes en la solicitud
        $conductorVehiculo->update($validatedData);
    
        // Responder con un mensaje y los datos actualizados
        return response()->json([
            'msg' => [
                'summary' => 'Asignación de vehículo actualizada',
                'detail' => 'Los datos de la asignación de vehículo se actualizaron correctamente.',
            ],
            'data' => $conductorVehiculo
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
                'summary' => 'Asignación de vehículo eliminada',
                'detail' => 'La asignación de vehículo se eliminó correctamente.',
            ],
            'data' => $conductor_vehiculo
        ]);
    }
}

