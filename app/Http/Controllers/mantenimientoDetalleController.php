<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mantenimientoDetalle;

class mantenimientoDetalleController extends Controller
{
    public function index()
    {
        $mantenimiento_detalles = mantenimientoDetalle::get();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta de mantenimientos detallados',
                    'detail' => 'Los mantenimientos detallados se consultaron correctamente.',
                ],
                'data' => $mantenimiento_detalles
            ]
        );
    }

    public function show($id)
    {
        $mantenimiento_detalle = mantenimientoDetalle::find($id);
        if (!$mantenimiento_detalle) {
            return response()->json([
                'msg' => [
                    'summary' => 'Mantenimiento detallado no encontrado',
                    'detail' => 'No se encontró el mantenimiento detallado con el ID proporcionado.',
                ],
                'data' => null
            ], 404);
        }
    
        return response()->json([
            'msg' => [
                'summary' => 'Consulta de mantenimiento detallado',
                'detail' => 'El mantenimiento detallado se consultó correctamente.',
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

        // Crear el nuevo mantenimiento detallado
        $mantenimiento_detalle = mantenimientoDetalle::create([
            'descripcion' => $request->input('descripcion'),
            'observacion' => $request->input('observacion'),
        ]);

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Mantenimiento detallado creado',
                'detail' => 'El mantenimiento detallado se creó correctamente.',
            ],
            'data' => $mantenimiento_detalle
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $mantenimiento_detalle = mantenimientoDetalle::findOrFail($id);

        // Validación para todos los campos, permitiendo algunos opcionales
        $validatedData = $request->validate([
            'descripcion' => 'sometimes|string',
            'observacion' => 'sometimes|string',
        ]);

        // Actualizar solo los campos que están presentes en la solicitud
        $mantenimiento_detalle->update($validatedData);

        return response()->json([
            'msg' => [
                'summary' => 'Mantenimiento detallado actualizado',
                'detail' => 'El mantenimiento detallado se actualizó correctamente.',
            ],
            'data' => $mantenimiento_detalle
        ]);
    }

    public function destroy($id)
    {
        // Buscar el mantenimiento detallado por su ID
        $mantenimiento_detalle = mantenimientoDetalle::findOrFail($id);

        // Eliminar el mantenimiento detallado
        $mantenimiento_detalle->delete();

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Mantenimiento detallado eliminado',
                'detail' => 'El mantenimiento detallado se eliminó correctamente.',
            ],
            'data' => $mantenimiento_detalle
        ]);
    }
}
