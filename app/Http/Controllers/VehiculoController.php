<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;

class VehiculoController extends Controller
{
    public function index()
    {
        $vehiculos = Vehiculo::get();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta de vehículos',
                    'detail' => 'Los vehículos se consultaron correctamente.',
                ],
                'data' => $vehiculos
            ]
        );
    }

    public function show($id)
    {
        $vehiculo = Vehiculo::find($id);
        if (!$vehiculo) {
            return response()->json([
                'msg' => [
                    'summary' => 'Vehículo no encontrado',
                    'detail' => 'No se encontró el vehículo con el ID proporcionado.',
                ],
                'data' => null
            ], 404);
        }
    
        return response()->json([
            'msg' => [
                'summary' => 'Consulta de vehículo',
                'detail' => 'El vehículo se consultó correctamente.',
            ],
            'data' => $vehiculo
        ]);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'tipo_vehiculo_id' => 'sometimes|integer|exists:tipo_vehiculo,id',
            'estado_id' => 'sometimes|integer|exists:estado,id',
            'placa' => 'sometimes|string',
            'marca' => 'sometimes|string',
            'modelo' => 'sometimes|string',
            'anio' => 'sometimes|integer',
            'tipo_contrato' => 'sometimes|string',
            'capacidad' => 'sometimes|integer',
        ]);

        // Crear la nueva asignación
        $vehiculo = Vehiculo::create([
            'tipo_vehiculo_id' => $request->input('tipo_vehiculo_id'),
            'estado_id' => $request->input('estado_id'),
            'placa' => $request->input('placa'),
            'marca' => $request->input('marca'),
            'modelo' => $request->input('modelo'),
            'anio' => $request->input('anio'),
            'tipo_contrato' => $request->input('tipo_contrato'),
            'capacidad' => $request->input('capacidad'),
        ]);

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Vehículo creado',
                'detail' => 'El vehículo se creó correctamente.',
            ],
            'data' => $vehiculo
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $vehiculo = Vehiculo::findOrFail($id);

        // Validación para todos los campos, pero permitiendo que algunos sean opcionales
        $validatedData = $request->validate([
            'tipo_vehiculo_id' => 'sometimes|integer|exists:tipo_vehiculo,id',
            'estado_id' => 'sometimes|integer|exists:estado,id',
            'placa' => 'sometimes|string',
            'marca' => 'sometimes|string',
            'modelo' => 'sometimes|string',
            'anio' => 'sometimes|integer',
            'tipo_contrato' => 'sometimes|string',
            'capacidad' => 'sometimes|integer',
        ]);

        // Actualizar solo los campos que están presentes en la solicitud
        $vehiculo->update($validatedData);

        return response()->json([
            'msg' => [
                'summary' => 'Vehículo actualizado',
                'detail' => 'El vehículo se actualizó correctamente.',
            ],
            'data' => $vehiculo
        ]);
    }
    
    public function destroy($id)
    {
        // Buscar la asignación por su ID
        $vehiculo = Vehiculo::findOrFail($id);

        // Eliminar la asignación
        $vehiculo->delete();

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Vehículo eliminado',
                'detail' => 'El vehículo se eliminó correctamente.',
            ],
            'data' => $vehiculo
        ]);
    }


    public function filter(Request $request)
    {
        $query = Vehiculo::query();
        
        // Filtrar por placa si se proporciona (comparación exacta)
        if ($request->has('placa') && $request->input('placa') != '') {
            $query->where('placa', '=', $request->input('placa'));
        }
        
        // Obtener los resultados filtrados
        $vehiculos = $query->get();
        
        return response()->json([
            'msg' => [
                'summary' => 'Consulta filtrada de vehiculos',
                'detail' => 'Los vehiculos se consultaron correctamente según el filtro aplicado.',
            ],
            'data' => $vehiculos
        ]);
    }
}
