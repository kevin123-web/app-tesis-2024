<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mantenimientoDetalle;


class mantenimientoDetalleController extends Controller
{
    public function index()
    {
        $mantenimiento_detalle = mantenimientoDetalle::get();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta de la asignación',
                    'detail' => 'La asignación se consulto  correctamente',
                ],
                'data' => $mantenimiento_detalle
            ]
        );
    }

    public function show($id)
    {
        $mantenimiento_detalle = mantenimientoDetalle::find($id);
        if (!$mantenimiento_detalle) {
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
            'data' => $mantenimiento_detalle
        ]);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'descripcion' => 'required|string',
            'observacion' => 'required|string',
        ]);

        // Crear la nueva asignación
        $mantenimiento_detalle = mantenimientoDetalle::create([
            'descripcion' => $request->input('descripcion'),
            'observacion' => $request->input('observacion'),
        ]);

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Asignación creada',
                'detail' => 'La asignación se creó correctamente',
            ],
            'data' => $mantenimiento_detalle
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $mantenimiento_detalle = mantenimientoDetalle::findOrFail($id);

        // Validación para todos los campos, pero permitiendo que algunos sean opcionales
        $validatedData = $request->validate([
            'descripcion' => 'sometimes|string',
            'observacion' => 'sometimes|string',
        ]);

        // Actualizar solo los campos que están presentes en la solicitud
        $mantenimiento_detalle->update($validatedData);

        return response()->json([
            'msg' => [
                'summary' => 'Actualización de la asignación',
                'detail' => 'La asignación se actualizó correctamente',
            ],
            'data' => $mantenimiento_detalle
        ]);
    }

    public function destroy($id)
    {
        // Buscar la asignación por su ID
        $mantenimiento_detalle = mantenimientoDetalle::findOrFail($id);

        // Eliminar la asignación
        $mantenimiento_detalle->delete();

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Asignación eliminada',
                'detail' => 'La asignación se eliminó correctamente',
            ],
            'data' => $mantenimiento_detalle
        ]);
    }
}
