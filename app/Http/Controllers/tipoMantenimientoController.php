<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tipoMantenimiento;


class tipoMantenimientoController extends Controller
{
    public function index()
    {
        $tipo_mantenimiento = tipoMantenimiento::get();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta de la asignación',
                    'detail' => 'La asignación se consulto  correctamente',
                ],
                'data' => $tipo_mantenimiento
            ]
        );
    }

    public function show($id)
    {
        $tipo_mantenimiento = tipoMantenimiento::find($id);
        if (!$tipo_mantenimiento) {
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
            'data' => $tipo_mantenimiento
        ]);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required|string',
        ]);

        // Crear la nueva asignación
        $tipo_mantenimiento = tipoMantenimiento::create([
            'nombre' => $request->input('nombre'),
        ]);

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Asignación creada',
                'detail' => 'La asignación se creó correctamente',
            ],
            'data' => $tipo_mantenimiento
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $tipo_mantenimiento = tipoMantenimiento::findOrFail($id);

        // Validación para todos los campos, pero permitiendo que algunos sean opcionales
        $validatedData = $request->validate([
            'nombre' => 'sometimes|string',
        ]);

        // Actualizar solo los campos que están presentes en la solicitud
        $tipo_mantenimiento->update($validatedData);

        return response()->json([
            'msg' => [
                'summary' => 'Actualización de la asignación',
                'detail' => 'La asignación se actualizó correctamente',
            ],
            'data' => $tipo_mantenimiento
        ]);
    }

    public function destroy($id)
    {
        // Buscar la asignación por su ID
        $tipo_mantenimiento = tipoMantenimiento::findOrFail($id);

        // Eliminar la asignación
        $tipo_mantenimiento->delete();

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Asignación eliminada',
                'detail' => 'La asignación se eliminó correctamente',
            ],
            'data' => $tipo_mantenimiento
        ]);
    }
}
