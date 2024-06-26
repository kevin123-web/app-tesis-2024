<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conductor;


class ConductorController extends Controller
{
    public function index()
    {
        $conductores = Conductor::get();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta de la asignación',
                    'detail' => 'La asignación se consulto  correctamente',
                ],
                'data' => $conductores
            ]
        );
    }

    public function show($id)
    {
        $conductores = Conductor::find($id);
        if (!$conductores) {
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
            'data' => $conductores
        ]);
    }
    
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'estado_id' => 'required|integer|exists:estado,id',
            'persona_id' => 'required|integer|exists:persona,id',
            'licencia_conducir' => 'required|string|max:20',
            'hacer_user' => 'required|boolean',

        ]);

        // Crear la nueva asignación
        $conductores = Conductor::create([
            'estado_id' => $request->input('estado_id'),
            'persona_id' => $request->input('persona_id'),
            'licencia_conducir' => $request->input('licencia_conducir'),
            'hacer_user' => $request->input('hacer_user'),
        ]);

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Asignación creada',
                'detail' => 'La asignación se creó correctamente',
            ],
            'data' => $conductores
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $conductores = Conductor::findOrFail($id);
    
        // Validación para todos los campos, pero permitiendo que algunos sean opcionales
        $validatedData = $request->validate([
            'estado_id' => 'sometimes|integer|exists:estado,id',
            'persona_id' => 'sometimes|integer|exists:persona,id',
            'licencia_conducir' => 'sometimes|string|max:20',
            'hacer_user' => 'sometimes|boolean',
        ]);
    
        // Actualizar solo los campos que están presentes en la solicitud
        $conductores->update($validatedData);
    
        return response()->json([
            'msg' => [
                'summary' => 'Actualización de la asignación',
                'detail' => 'La asignación se actualizó correctamente',
            ],
            'data' => $conductores
        ]);
    }
    

    public function destroy($id)
    {
        // Buscar la asignación por su ID
        $conductores = Conductor::findOrFail($id);

        // Eliminar la asignación
        $conductores->delete();

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Asignación eliminada',
                'detail' => 'La asignación se eliminó correctamente',
            ],
            'data' => $conductores
        ]);
    }
}
