<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;


class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::with(['persona'])->get();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta del cliente',
                    'detail' => 'El cliente se consulto  correctamente',
                ],
                'data' => $clientes
            ]
        );
    }

    public function show($id)
    {
        $clientes = Cliente::find($id);
        if (!$clientes) {
            return response()->json([
                'msg' => [
                    'summary' => 'Cliente no encontrado',
                    'detail' => ' El cliente con el ID proporcionado no fue encontrado',
                ],
                'data' => null
            ], 404);
        }
    
        return response()->json([
            'msg' => [
                'summary' => 'Consulta del cliente',
                'detail' => 'El cliente se consulto  correctamente',
            ],
            'data' => $clientes
        ]);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'persona_id' => 'required|integer|exists:persona,id',
            // 'fecha_registro' => 'required|date',
            'tipo_cliente' => 'required|string|max:255',
        ]);

        // Crear la nueva asignación
        $clientes = Cliente::create([
            'persona_id' => $request->input('persona_id'),
            // 'fecha_registro' => $request->input('fecha_registro'),
            'tipo_cliente' => $request->input('tipo_cliente'),
        ]);

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Cliente creado',
                'detail' => 'El cliente se creó correctamente',
            ],
            'data' => $clientes
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $clientes = Cliente::findOrFail($id);
    
        // Validación para todos los campos, pero permitiendo que algunos sean opcionales
        $validatedData = $request->validate([
            'persona_id' => 'sometimes|integer|exists:persona,id',
            'fecha_registro' => 'sometimes|date',
            'tipo_cliente' => 'sometimes|string|max:255',
        ]);
    
        // Actualizar solo los campos que están presentes en la solicitud
        $clientes->update($validatedData);
    
        return response()->json([
            'msg' => [
                'summary' => 'Actualización del cliente',
                'detail' => 'El cliente se actualizó correctamente',
            ],
            'data' => $clientes
        ]);
    }

    public function destroy($id)
    {
        // Buscar la asignación por su ID
        $clientes = Cliente::findOrFail($id);

        // Eliminar la asignación
        $clientes->delete();

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Cliente eliminado',
                'detail' => 'El cliente se eliminó correctamente',
            ],
            'data' => $clientes
        ]);
    }


    public function filter(Request $request)
    {
        $query = Cliente::query();
        
        // Filtrar por id_persona si se proporciona (comparación exacta)
        if ($request->has('persona_id') && $request->input('persona_id') != '') {
            $query->where('persona_id', '=', $request->input('persona_id'));
        }
        
        // Obtener los resultados filtrados
        $clientes = $query->get();
        
        return response()->json([
            'msg' => [
                'summary' => 'Consulta filtrada de clientes',
                'detail' => 'Los clientes se consultaron correctamente según el filtro aplicado.',
            ],
            'data' => $clientes
        ]);
    }
}
