<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruta;


class RutaController extends Controller
{
    public function index()
    {
        $rutas = Ruta::all();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta de rutas',
                    'detail' => 'Las rutas se consultaron correctamente.',
                ],
                'data' => $rutas
            ]
        );
    }

    public function show($id)
    {
        $ruta = Ruta::find($id);
        if (!$ruta) {
            return response()->json([
                'msg' => [
                    'summary' => 'Ruta no encontrada',
                    'detail' => 'No se encontró la ruta con el ID proporcionado.',
                ],
                'data' => null
            ], 404);
        }
    
        return response()->json([
            'msg' => [
                'summary' => 'Consulta de ruta',
                'detail' => 'La ruta se consultó correctamente.',
            ],
            'data' => $ruta
        ]);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'ubicacion_origen_id' => 'required|integer|exists:ubicacion_origen,id',
            'ubicacion_destino_id' => 'required|integer|exists:ubicacion_destino,id',
            'duracion' => 'required|string',
            'distancia' => 'required|string',
        ]);

        // Crear la nueva ruta
        $ruta = Ruta::create([
            'ubicacion_origen_id' => $request->input('ubicacion_origen_id'),
            'ubicacion_destino_id' => $request->input('ubicacion_destino_id'),
            'duracion' => $request->input('duracion'),
            'distancia' => $request->input('distancia'),
        ]);

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Ruta creada',
                'detail' => 'La ruta se creó correctamente.',
            ],
            'data' => $ruta
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $ruta = Ruta::findOrFail($id);

        // Validación para los campos, permitiendo algunos opcionales
        $validatedData = $request->validate([
            'ubicacion_origen_id' => 'sometimes|integer|exists:ubicacion_origen,id',
            'ubicacion_destino_id' => 'sometimes|integer|exists:ubicacion_destino,id',
            'duracion' => 'required|string',
            'distancia' => 'required|string',
        ]);

        // Actualizar solo los campos que están presentes en la solicitud
        $ruta->update($validatedData);

        return response()->json([
            'msg' => [
                'summary' => 'Ruta actualizada',
                'detail' => 'La ruta se actualizó correctamente.',
            ],
            'data' => $ruta
        ]);
    }

    public function destroy($id)
    {
        // Buscar la ruta por su ID
        $ruta = Ruta::findOrFail($id);

        // Eliminar la ruta
        $ruta->delete();

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Ruta eliminada',
                'detail' => 'La ruta se eliminó correctamente.',
            ],
            'data' => $ruta
        ]);
    }
}
