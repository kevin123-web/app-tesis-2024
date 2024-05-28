<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ubicacionOrigen;

class ubicacionOrigenController extends Controller
{
    public function index()
    {
        $ubicacion_origen = ubicacionOrigen::get();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta de la asignación',
                    'detail' => 'La asignación se consulto  correctamente',
                ],
                'data' => $ubicacion_origen
            ]
        );
    }

    public function show($id)
    {
        $ubicacion_origen = ubicacionOrigen::find($id);
        if (!$ubicacion_origen) {
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
            'data' => $ubicacion_origen
        ]);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required|string',
        ]);

        // Crear la nueva asignación
        $ubicacion_origen = ubicacionOrigen::create([
            'nombre' => $request->input('nombre'),
        ]);

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Asignación creada',
                'detail' => 'La asignación se creó correctamente',
            ],
            'data' => $ubicacion_origen
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $ubicacion_origen = ubicacionOrigen::findOrFail($id);

        // Validación para todos los campos, pero permitiendo que algunos sean opcionales
        $validatedData = $request->validate([
            'nombre' => 'sometimes|string',
        ]);

        // Actualizar solo los campos que están presentes en la solicitud
        $ubicacion_origen->update($validatedData);

        return response()->json([
            'msg' => [
                'summary' => 'Actualización de la asignación',
                'detail' => 'La asignación se actualizó correctamente',
            ],
            'data' => $ubicacion_origen
        ]);
    }

    public function destroy($id)
    {
        // Buscar la asignación por su ID
        $ubicacion_origen = ubicacionOrigen::findOrFail($id);

        // Eliminar la asignación
        $ubicacion_origen->delete();

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Asignación eliminada',
                'detail' => 'La asignación se eliminó correctamente',
            ],
            'data' => $ubicacion_origen
        ]);
    }
}
