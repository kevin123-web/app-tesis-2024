<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tipoIdentificacion;


class tipoIdentificacionController extends Controller
{
    public function index()
    {
        $tipo_identificacion = tipoIdentificacion::get();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta de la asignación',
                    'detail' => 'La asignación se consulto  correctamente',
                ],
                'data' => $tipo_identificacion
            ]
        );
    }

    public function show($id)
    {
        $tipo_identificacion = tipoIdentificacion::find($id);
        if (!$tipo_identificacion) {
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
            'data' => $tipo_identificacion
        ]);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required|string',
        ]);

        // Crear la nueva asignación
        $tipo_identificacion = tipoIdentificacion::create([
            'nombre' => $request->input('nombre'),
        ]);

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Asignación creada',
                'detail' => 'La asignación se creó correctamente',
            ],
            'data' => $tipo_identificacion
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $tipo_identificacion = tipoIdentificacion::findOrFail($id);

        // Validación para todos los campos, pero permitiendo que algunos sean opcionales
        $validatedData = $request->validate([
            'nombre' => 'sometimes|string',
        ]);

        // Actualizar solo los campos que están presentes en la solicitud
        $tipo_identificacion->update($validatedData);

        return response()->json([
            'msg' => [
                'summary' => 'Actualización de la asignación',
                'detail' => 'La asignación se actualizó correctamente',
            ],
            'data' => $tipo_identificacion
        ]);
    }

    public function destroy($id)
    {
        // Buscar la asignación por su ID
        $tipo_identificacion = tipoIdentificacion::findOrFail($id);

        // Eliminar la asignación
        $tipo_identificacion->delete();

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Asignación eliminada',
                'detail' => 'La asignación se eliminó correctamente',
            ],
            'data' => $tipo_identificacion
        ]);
    }
}
