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
        $envio = Envios::with([
            'cliente.persona', 
            'asignacion' => function($query) {
                $query->with(['ruta','ConductorVehiculo']);
            },
            'servicio', 
            'estado'
            ])->find($id);
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
            'prioridad' => 'required|string',
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
            'prioridad' => $request->input('prioridad'),
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
            'prioridad' => 'required|string',
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

    public function filterByCreationDate(Request $request)
    {
        // Validar start_date y end_date, ambos son opcionales
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);
    
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        // Construir la consulta
        $query = Envios::with([
            'cliente.persona',
            'asignacion' => function($query) {
                $query->with(['ruta', 'ConductorVehiculo']);
            },
            'servicio',
            'estado'
        ]);
    
        // Aplicar filtros según los parámetros proporcionados
        if ($startDate && $endDate) {
            // Ambos start_date y end_date proporcionados
            if ($startDate > $endDate) {
                // start_date es posterior a end_date, no hay resultados posibles
                $query->whereRaw('1 = 0'); // Esta condición nunca será verdadera
            } else {
                // Filtrar por registros creados entre start_date y end_date
                $query->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
            }
        } elseif ($startDate) {
            // Solo start_date proporcionado, filtrar por registros creados desde start_date
            $query->whereDate('created_at', '>=', $startDate);
        } elseif ($endDate) {
            // Solo end_date proporcionado, filtrar por registros creados hasta end_date
            $query->whereDate('created_at', '<=', $endDate);
        }
    
        // Obtener los resultados
        $envios = $query->get();
    
        // Verificar si hay resultados
        if ($envios->isEmpty()) {
            return response()->json([
                'msg' => [
                    'summary' => 'No hay registros',
                    'detail' => 'No se encontraron envíos para el rango de fechas especificado.',
                ],
                'data' => []
            ]);
        }
    
        return response()->json([
            'msg' => [
                'summary' => 'Lista de envíos filtrados',
                'detail' => 'Se consultaron los envíos correctamente según el rango de fechas de creación.',
            ],
            'data' => $envios
        ]);
    }
    
    public function index1 (Request $request)
    {
        // Obtener el cliente_id del query string
        $clienteId = $request->query('cliente_id');

        // Construir la consulta base
        $query = Envios::query();

        // Si se proporciona cliente_id, aplicar el filtro
        if ($clienteId) {
            $query->where('cliente_id', $clienteId);
        }

        // Ejecutar la consulta y obtener los resultados
        $envios = $query->get();

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Envíos recuperados',
                'detail' => 'Los envíos fueron recuperados correctamente.',
            ],
            'data' => $envios
        ]);
    }

}
