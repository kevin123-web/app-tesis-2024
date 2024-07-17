<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tipoIntervalo;


class tipoIntervaloController extends Controller
{
    public function index()
    {
        $tiposIntervalo = tipoIntervalo::all();
        return response()->json([
            'msg' => [
                'summary' => 'Consulta de tipos de intervalo',
                'detail' => 'Los tipos de intervalo se consultaron correctamente.',
            ],
            'data' => $tiposIntervalo
        ]);
    }

    public function show($id)
    {
        $tipoIntervalo = tipoIntervalo::find($id);
        if (!$tipoIntervalo) {
            return response()->json([
                'msg' => [
                    'summary' => 'Tipo de intervalo no encontrado',
                    'detail' => 'No se encontró el tipo de intervalo con el ID proporcionado.',
                ],
                'data' => null
            ], 404);
        }
    
        return response()->json([
            'msg' => [
                'summary' => 'Consulta de tipo de intervalo',
                'detail' => 'El tipo de intervalo se consultó correctamente.',
            ],
            'data' => $tipoIntervalo
        ]);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required|string',
        ]);

        // Crear el nuevo tipo de intervalo
        $tipoIntervalo = tipoIntervalo::create([
            'nombre' => $request->input('nombre'),
        ]);

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Tipo de intervalo creado',
                'detail' => 'El tipo de intervalo se creó correctamente.',
            ],
            'data' => $tipoIntervalo
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $tipoIntervalo = tipoIntervalo::findOrFail($id);

        // Validación para campos opcionales
        $validatedData = $request->validate([
            'nombre' => 'sometimes|string',
        ]);

        // Actualizar solo los campos que están presentes en la solicitud
        $tipoIntervalo->update($validatedData);

        return response()->json([
            'msg' => [
                'summary' => 'Tipo de intervalo actualizado',
                'detail' => 'El tipo de intervalo se actualizó correctamente.',
            ],
            'data' => $tipoIntervalo
        ]);
    }

    public function destroy($id)
    {
        // Buscar el tipo de intervalo por su ID
        $tipoIntervalo = tipoIntervalo::findOrFail($id);

        // Eliminar el tipo de intervalo
        $tipoIntervalo->delete();

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Tipo de intervalo eliminado',
                'detail' => 'El tipo de intervalo se eliminó correctamente.',
            ],
            'data' => $tipoIntervalo
        ]);
    }
}
