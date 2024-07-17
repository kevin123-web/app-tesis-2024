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
                    'summary' => 'Lista de conductores',
                    'detail' => 'Se obtuvo la lista de conductores correctamente.',
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
                    'summary' => 'Conductor no encontrado',
                    'detail' => 'No se encontró un conductor con el ID proporcionado.',
                ],
                'data' => null
            ], 404);
        }
    
        return response()->json([
            'msg' => [
                'summary' => 'Detalles del conductor',
                'detail' => 'Se consultaron los detalles del conductor correctamente.',
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
                'summary' => 'Conductor registrado',
                'detail' => 'El conductor se registró correctamente.',
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
                'summary' => 'Conductor actualizado',
                'detail' => 'Los datos del conductor se actualizaron correctamente.',
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
                'summary' => 'Conductor eliminado',
                'detail' => 'El conductor se eliminó correctamente.',
            ],
            'data' => $conductores
        ]);
    }

    public function filter(Request $request)
    {
        $query = Conductor::query();

        // Filtrar por licencia de conducir si se proporciona
        if ($request->has('licencia_conducir') && $request->input('licencia_conducir') != '') {
            $query->where('licencia_conducir', 'like', '%' . $request->input('licencia_conducir') . '%');
        }

        // Obtener los resultados filtrados
        $conductores = $query->get();

        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta filtrada de conductores',
                    'detail' => 'Los conductores se consultaron correctamente según el filtro aplicado.',
                ],
                'data' => $conductores
            ]
        );
    }
}
