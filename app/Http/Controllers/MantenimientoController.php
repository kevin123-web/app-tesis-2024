<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mantenimiento;

class MantenimientoController extends Controller
{
    public function index()
    {
        $mantenimientos = Mantenimiento::with(['vehiculo', 'mantenimientoDetalle', 'tipoMantenimiento', 'tipoIntervalo'])->get();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta de mantenimientos',
                    'detail' => 'Los mantenimientos se consultaron correctamente.',
                ],
                'data' => $mantenimientos
            ]
        );
    }

    public function show($id)
    {
        $mantenimiento = Mantenimiento::with(['vehiculo', 'mantenimientoDetalle', 'tipoMantenimiento', 'tipoIntervalo'])->find($id);
        if (!$mantenimiento) {
            return response()->json([
                'msg' => [
                    'summary' => 'Mantenimiento no encontrado',
                    'detail' => 'No se encontró un mantenimiento con el ID proporcionado.',
                ],
                'data' => null
            ], 404);
        }
    
        return response()->json([
            'msg' => [
                'summary' => 'Consulta de mantenimiento',
                'detail' => 'El mantenimiento se consultó correctamente.',
            ],
            'data' => $mantenimiento
        ]);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'vehiculo_id' => 'required|integer|exists:vehiculo,id',
            'mantenimiento_detalle_id' => 'required|integer|exists:mantenimiento_detalle,id',
            'maquinaria_id' => 'integer|exists:maquinaria,id',
            'tipo_mantenimiento_id' => 'required|integer|exists:tipo_mantenimiento,id',
            'tipo_intervalo_id' => 'required|integer|exists:tipo_intervalo,id',
            'fecha_mantenimiento' => 'required|date',
            'costo_mantenimiento' => 'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
            'intervalo_numero' => 'required|integer',
        ]);

        // Crear el nuevo mantenimiento
        $mantenimiento = Mantenimiento::create([
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
                'summary' => 'Mantenimiento creado',
                'detail' => 'El mantenimiento se creó correctamente.',
            ],
            'data' => $mantenimiento
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $mantenimiento = Mantenimiento::findOrFail($id);

        // Validación para todos los campos, permitiendo algunos opcionales
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

        // Actualizar solo los campos presentes en la solicitud
        $mantenimiento->update($validatedData);

        return response()->json([
            'msg' => [
                'summary' => 'Mantenimiento actualizado',
                'detail' => 'El mantenimiento se actualizó correctamente.',
            ],
            'data' => $mantenimiento
        ]);
    }

    public function destroy($id)
    {
        // Buscar el mantenimiento por su ID
        $mantenimiento = Mantenimiento::findOrFail($id);

        // Eliminar el mantenimiento
        $mantenimiento->delete();

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Mantenimiento eliminado',
                'detail' => 'El mantenimiento se eliminó correctamente.',
            ],
            'data' => $mantenimiento
        ]);
    }
}
