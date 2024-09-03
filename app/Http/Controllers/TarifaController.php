<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarifa;


class TarifaController extends Controller
{
    public function index()
    {
        $tarifas = Tarifa::get();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta de tarifas',
                    'detail' => 'Las tarifas se consultaron correctamente.',
                ],
                'data' => $tarifas
            ]
        );
    }

    public function show($id)
    {
        $tarifas = Tarifa::find($id);
        if (!$tarifas) {
            return response()->json([
                'msg' => [
                    'summary' => 'Tarifa no encontrada',
                    'detail' => 'No se encontró la tarifa con el ID proporcionado.',
                ],
                'data' => null
            ], 404);
        }
    
        return response()->json([
            'msg' => [
                'summary' => 'Consulta de tarifas',
                'detail' => 'Las tarifas se consultó correctamente.',
            ],
            'data' => $tarifas
        ]);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'tipo_vehiculo_id' => 'sometimes|integer|exists:tipo_vehiculo,id',
            'valor' => 'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',

        ]);

        // Crear la nueva tarifa
        $tarifas = Tarifa::create([
            'tipo_vehiculo_id' => $request->input('tipo_vehiculo_id'),
            'valor' => $request->input('valor'),
    
        ]);

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Tarifa creada',
                'detail' => 'La tarifa se creó correctamente.',
            ],
            'data' => $tarifas
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $tarifas = Tarifa::findOrFail($id);

        // Validación para todos los campos, pero permitiendo que algunos sean opcionales
        $validatedData = $request->validate([
            'tipo_vehiculo_id' => 'sometimes|integer|exists:tipo_vehiculo,id',
            'valor' => 'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/'
        ]);

        // Actualizar solo los campos que están presentes en la solicitud
        $tarifas->update($validatedData);

        return response()->json([
            'msg' => [
                'summary' => 'Tarifa actualizada',
                'detail' => 'La tarifa se actualizó correctamente.',
            ],
            'data' => $tarifas
        ]);
    }
    
    public function destroy($id)
    {
        // Buscar la asignación por su ID
        $tarifas = Tarifa::findOrFail($id);

        // Eliminar la asignación
        $tarifas->delete();

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Tarifa eliminada',
                'detail' => 'La tarifa se eliminó correctamente.',
            ],
            'data' => $tarifas
        ]);
    }
}