<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mantenimiento;


class MantenimientoController extends Controller
{
    public function index()
    {
        $mantenimientos = Mantenimiento::get();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta de la asignación',
                    'detail' => 'La asignación se consulto  correctamente',
                ],
                'data' => $mantenimientos
            ]
        );
    }

    public function show($id)
    {
        $mantenimientos = Mantenimiento::find($id);
        if (!$mantenimientos) {
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
            'data' => $mantenimientos
        ]);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'vehiculo_id' => 'required|integer|exists:vehiculo,id',
            'mantenimiento_detalle_id' => 'required|integer|exists:mantenimiento_detalle,id',
            'maquinaria_id' => 'required|integer|exists:maquinaria,id',
            'tipo_mantenimiento_id' => 'required|integer|exists:tipo_mantenimiento,id',
            'tipo_intervalo_id' => 'required|integer|exists:tipo_intervalo,id',
            'fecha_mantenimiento' => 'required|date',
            'costo_mantenimiento' => 'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
            'intervalo_numero' => 'required|integer',
        ]);

        // Crear la nueva asignación
        $mantenimientos = Mantenimiento::create([
            'vehiculo_id' => $request->input('vehiculo_id'),
            'mantenimiento_detalle_id' => $request->input('mantenimiento_detalle_id'),
            'maquinaria_id' => $request->input('maquinaria_id'),
            'tipo_mantenimiento_id' => $request->input('tipo_mantenimiento_id'),
            'tipo_intervalo_id' => $request->input('tipo_intervalo_id'),
            'fecha_mantenimiento' => $request->input('fecha_mantenimiento'),
            'costo_mantenimiento' => $request->input('costo_mantenimiento'),
            'intervalo_numero' => $request->input('intervalo_numero'),
        ]);

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Asignación creada',
                'detail' => 'La asignación se creó correctamente',
            ],
            'data' => $mantenimientos
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $mantenimientos = Mantenimiento::findOrFail($id);

        // Validación para todos los campos, pero permitiendo que algunos sean opcionales
        $validatedData = $request->validate([
            'vehiculo_id' => 'sometimes|integer|exists:vehiculo,id',
            'mantenimiento_detalle_id' => 'sometimes|integer|exists:mantenimiento_detalle,id',
            'maquinaria_id' => 'sometimes|integer|exists:maquinaria,id',
            'tipo_mantenimiento_id' => 'sometimes|integer|exists:tipo_mantenimiento,id',
            'tipo_intervalo_id' => 'sometimes|integer|exists:tipo_intervalo,id',
            'fecha_mantenimiento' => 'sometimes|date',
            'costo_mantenimiento' => 'sometimes|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
            'intervalo_numero' => 'sometimes|integer',
        ]);

        // Actualizar solo los campos que están presentes en la solicitud
        $mantenimientos->update($validatedData);

        return response()->json([
            'msg' => [
                'summary' => 'Actualización de la asignación',
                'detail' => 'La asignación se actualizó correctamente',
            ],
            'data' => $mantenimientos
        ]);
    }

    public function destroy($id)
    {
        // Buscar la asignación por su ID
        $mantenimientos = Mantenimiento::findOrFail($id);

        // Eliminar la asignación
        $mantenimientos->delete();

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Asignación eliminada',
                'detail' => 'La asignación se eliminó correctamente',
            ],
            'data' => $mantenimientos
        ]);
    }
}
