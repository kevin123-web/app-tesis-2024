<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estado;

class EstadoController extends Controller
{
    public function index()
    {
        $estados = Estado::get();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta del estado',
                    'detail' => 'El estado se consulto  correctamente',
                ],
                'data' => $estados
            ]
        );
    }

    public function show($id)
    {
        $estados = Estado::find($id);
        if (!$estados) {
            return response()->json([
                'msg' => [
                    'summary' => 'Estado no encontrado',
                    'detail' => 'El estado con el ID proporcionado no fue encontrado',
                ],
                'data' => null
            ], 404);
        }
    
        return response()->json([
            'msg' => [
                'summary' => 'Consulta de estado',
                'detail' => 'El estado se consultó correctamente',
            ],
            'data' => $estados
        ]);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
        'nombre' => 'required|string|max:255',
        ]);

        // Crear el nuevo estado
        $estado = Estado::create([
            'nombre' => $request->input('nombre'),
        ]);

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Estado creado',
                'detail' => 'El estado se creó correctamente',
            ],
            'data' => $estado
        ], 201);
    }

    public function update(Request $request, $id)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        // Buscar el estado por su ID
        $estado = Estado::findOrFail($id);

        // Actualizar el estado con los datos proporcionados
        $estado->update([
            'nombre' => $request->input('nombre'),
        ]);

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Estado actualizado',
                'detail' => 'El estado se actualizó correctamente',
            ],
            'data' => $estado
        ]);
    }

    public function destroy($id)
    {
        // Buscar el estado por su ID
        $estado = Estado::findOrFail($id);

        // Eliminar el estado
        $estado->delete();

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Estado eliminado',
                'detail' => 'El estado se eliminó correctamente',
            ],
            'data' => $estado
        ]);
    }
}
