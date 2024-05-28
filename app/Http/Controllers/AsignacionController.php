<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asignacion;


class AsignacionController extends Controller
{
    public function index()
    {
        $asignaciones = Asignacion::get();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta de la asignación',
                    'detail' => 'La asignación se consulto  correctamente',
                ],
                'data' => $asignaciones
            ]
        );
    }

    public function show($id)
    {
        $asignaciones = Asignacion::find($id);
        if (!$asignaciones) {
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
            'data' => $asignaciones
        ]);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'ruta_id' => 'required|integer|exists:ruta,id',
            'conductor_vehiculo_id' => 'required|integer|exists:conductor_vehiculo,id',
            'fecha' => 'required|date',
        ]);

        // Crear la nueva asignación
        $asignacion = Asignacion::create([
            'ruta_id' => $request->input('ruta_id'),
            'conductor_vehiculo_id' => $request->input('conductor_vehiculo_id'),
            'fecha' => $request->input('fecha'),
        ]);

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Asignación creada',
                'detail' => 'La asignación se creó correctamente',
            ],
            'data' => $asignacion
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $asignacion = Asignacion::findOrFail($id);

        // Validación para todos los campos, pero permitiendo que algunos sean opcionales
        $validatedData = $request->validate([
            'ruta_id' => 'sometimes|integer|exists:ruta,id',
            'conductor_vehiculo_id' => 'sometimes|integer|exists:conductor_vehiculo,id',
            'fecha' => 'sometimes|date',
        ]);

        // Actualizar solo los campos que están presentes en la solicitud
        $asignacion->update($validatedData);

        return response()->json([
            'msg' => [
                'summary' => 'Actualización de la asignación',
                'detail' => 'La asignación se actualizó correctamente',
            ],
            'data' => $asignacion
        ]);
    }
    
    public function destroy($id)
    {
        // Buscar la asignación por su ID
        $asignacion = Asignacion::findOrFail($id);

        // Eliminar la asignación
        $asignacion->delete();

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Asignación eliminada',
                'detail' => 'La asignación se eliminó correctamente',
            ],
            'data' => $asignacion
        ]);
    }
}
