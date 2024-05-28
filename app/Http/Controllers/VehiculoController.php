<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;


class VehiculoController extends Controller
{
    public function index()
    {
        $vehiculos = Vehiculo::get();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta de la asignación',
                    'detail' => 'La asignación se consulto  correctamente',
                ],
                'data' => $vehiculos
            ]
        );
    }

    public function show($id)
    {
        $vehiculos = Vehiculo::find($id);
        if (!$vehiculos) {
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
            'data' => $vehiculos
        ]);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'tipo_vehiculo_id' => 'sometimes|integer|exists:tipo_vehiculo,id',
            'estado_id' => 'sometimes|integer|exists:estado,id',
            'placa' => 'sometimes|string',
            'marca' => 'sometimes|string',
            'modelo' => 'sometimes|string',
            'anio' => 'sometimes|integer',
            'tipo_contrato' => 'sometimes|string',
            'capacidad' => 'sometimes|integer',
        ]);

        // Crear la nueva asignación
        $vehiculos = Vehiculo::create([
            'tipo_vehiculo_id' => $request->input('tipo_vehiculo_id'),
            'estado_id' => $request->input('estado_id'),
            'placa' => $request->input('placa'),
            'marca' => $request->input('marca'),
            'modelo' => $request->input('modelo'),
            'anio' => $request->input('anio'),
            'tipo_contrato' => $request->input('tipo_contrato'),
            'capacidad' => $request->input('capacidad'),
        ]);

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Asignación creada',
                'detail' => 'La asignación se creó correctamente',
            ],
            'data' => $vehiculos
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $vehiculos = Vehiculo::findOrFail($id);

        // Validación para todos los campos, pero permitiendo que algunos sean opcionales
        $validatedData = $request->validate([
            'tipo_vehiculo_id' => 'sometimes|integer|exists:tipo_vehiculo,id',
            'estado_id' => 'sometimes|integer|exists:estado,id',
            'placa' => 'sometimes|string',
            'marca' => 'sometimes|string',
            'modelo' => 'sometimes|string',
            'anio' => 'sometimes|integer',
            'tipo_contrato' => 'sometimes|string',
            'capacidad' => 'sometimes|integer',
        ]);

        // Actualizar solo los campos que están presentes en la solicitud
        $vehiculos->update($validatedData);

        return response()->json([
            'msg' => [
                'summary' => 'Actualización de la asignación',
                'detail' => 'La asignación se actualizó correctamente',
            ],
            'data' => $vehiculos
        ]);
    }
    
    public function destroy($id)
    {
        // Buscar la asignación por su ID
        $vehiculos = Vehiculo::findOrFail($id);

        // Eliminar la asignación
        $vehiculos->delete();

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Asignación eliminada',
                'detail' => 'La asignación se eliminó correctamente',
            ],
            'data' => $vehiculos
        ]);
    }
}
