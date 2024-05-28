<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruta;


class RutaController extends Controller
{
    public function index()
    {
        $rutas = Ruta::get();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta del estado',
                    'detail' => 'El estado se consulto  correctamente',
                ],
                'data' => $rutas
            ]
        );
    }

    public function show($id)
    {
        $rutas = Ruta::find($id);
        if (!$rutas) {
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
            'data' => $rutas
        ]);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'estado_id' => 'required|integer|exists:estado,id',
            'ubicacion_origen_id' => 'required|integer|exists:ubicacion_origen,id',
            'ubicacion_destino_id' => 'required|integer|exists:ubicacion_destino,id',
            'tiempo_estimado' => 'required|string',
            'distancia' => 'required|integer',
        ]);

        // Crear la nueva asignación
        $rutas = Ruta::create([
            'estado_id' => $request->input('estado_id'),
            'ubicacion_origen_id' => $request->input('ubicacion_origen_id'),
            'ubicacion_destino_id' => $request->input('ubicacion_destino_id'),
            'tiempo_estimado' => $request->input('tiempo_estimado'),
            'distancia' => $request->input('distancia'),
        ]);

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Asignación creada',
                'detail' => 'La asignación se creó correctamente',
            ],
            'data' => $rutas
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $rutas = Ruta::findOrFail($id);

        // Validación para todos los campos, pero permitiendo que algunos sean opcionales
        $validatedData = $request->validate([
            'estado_id' => 'sometimes|integer|exists:estado,id',
            'ubicacion_origen_id' => 'sometimes|integer|exists:ubicacion_origen,id',
            'ubicacion_destino_id' => 'sometimes|integer|exists:ubicacion_destino,id',
            'tiempo_estimado' => 'sometimes|string',
            'distancia' => 'sometimes|integer',
        ]);

        // Actualizar solo los campos que están presentes en la solicitud
        $rutas->update($validatedData);

        return response()->json([
            'msg' => [
                'summary' => 'Actualización de la asignación',
                'detail' => 'La asignación se actualizó correctamente',
            ],
            'data' => $rutas
        ]);
    }

    public function destroy($id)
    {
        // Buscar la asignación por su ID
        $rutas = Ruta::findOrFail($id);

        // Eliminar la asignación
        $rutas->delete();

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Asignación eliminada',
                'detail' => 'La asignación se eliminó correctamente',
            ],
            'data' => $rutas
        ]);
    }
}
