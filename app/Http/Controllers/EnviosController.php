<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Envios;

class EnviosController extends Controller
{
    public function index()
    {
        $envio = Envios::with([
            'cliente.persona', 
            'asignacion' => function($query) {
                $query->with(['ruta','ConductorVehiculo']);
            },
            'servicio', 
            'estado'
            ])->get();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Lista de envíos',
                    'detail' => 'Se consultaron los envíos correctamente.',
                ],
                'data' => $envio
            ]
        );
    }

    public function show($id)
    {
        $envio = Envios::find($id);
        if (!$envio) {
            return response()->json([
                'msg' => [
                    'summary' => 'Envío no encontrado',
                    'detail' => 'No se encontró un envío con el ID proporcionado.',
                ],
                'data' => null
            ], 404);
        }
    
        return response()->json([
            'msg' => [
                'summary' => 'Detalles del envío',
                'detail' => 'Se consultaron los detalles del envío correctamente.',
            ],
            'data' => $envio
        ]);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'cliente_id' => 'required|integer|exists:cliente,id',
            'asignacion_id' => 'required|integer|exists:asignacion,id',
            'servicio_id' => 'required|integer|exists:servicio,id',
            'estado_id' => 'required|integer|exists:estado,id',
            'descripcion' => 'required|string',
            'peso_mercancia' => 'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
            'fecha_recogida' => 'required|date',
            'fecha_entrega' => 'required|date',
        ]);

        // Crear el nuevo envío
        $envio = Envios::create([
            'cliente_id' => $request->input('cliente_id'),
            'asignacion_id' => $request->input('asignacion_id'),
            'servicio_id' => $request->input('servicio_id'),
            'estado_id' => $request->input('estado_id'),
            'descripcion' => $request->input('descripcion'),
            'peso_mercancia' => $request->input('peso_mercancia'),
            'fecha_recogida' => $request->input('fecha_recogida'),
            'fecha_entrega' => $request->input('fecha_entrega'),
        ]);

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Envío creado',
                'detail' => 'El envío se creó correctamente.',
            ],
            'data' => $envio
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $envio = Envios::findOrFail($id);

        // Validación para todos los campos, pero permitiendo que algunos sean opcionales
        $validatedData = $request->validate([
            'cliente_id' => 'sometimes|integer|exists:cliente,id',
            'asignacion_id' => 'sometimes|integer|exists:asignacion,id',
            'servicio_id' => 'sometimes|integer|exists:servicio,id',
            'estado_id' => 'sometimes|integer|exists:estado,id',
            'descripcion' => 'sometimes|string',
            'peso_mercancia' => 'sometimes|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
            'fecha_recogida' => 'sometimes|date',
            'fecha_entrega' => 'sometimes|date',
        ]);

        // Actualizar solo los campos que están presentes en la solicitud
        $envio->update($validatedData);

        return response()->json([
            'msg' => [
                'summary' => 'Envío actualizado',
                'detail' => 'Los datos del envío se actualizaron correctamente.',
            ],
            'data' => $envio
        ]);
    }

    public function destroy($id)
    {
        // Buscar el envío por su ID
        $envio = Envios::findOrFail($id);

        // Eliminar el envío
        $envio->delete();

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Envío eliminado',
                'detail' => 'El envío se eliminó correctamente.',
            ],
            'data' => $envio
        ]);
    }
}
