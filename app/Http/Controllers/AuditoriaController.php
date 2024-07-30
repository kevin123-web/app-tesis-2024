<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auditoria;

class AuditoriaController extends Controller
{
    public function index()
    {
        $auditorias = Auditoria::all();
        return response()->json([
            'msg' => [
                'summary' => 'Consulta de auditorías',
                'detail' => 'Las auditorías se consultaron correctamente.',
            ],
            'data' => $auditorias
        ]);
    }

    public function show($id)
    {
        $auditoria = Auditoria::find($id);
        if (!$auditoria) {
            return response()->json([
                'msg' => [
                    'summary' => 'Auditoría no encontrada',
                    'detail' => 'No se encontró la auditoría con el ID proporcionado.',
                ],
                'data' => null
            ], 404);
        }

        return response()->json([
            'msg' => [
                'summary' => 'Consulta de auditoría',
                'detail' => 'La auditoría se consultó correctamente.',
            ],
            'data' => $auditoria
        ]);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'envio_id' => 'required|integer|exists:envios,id',
            'usuario_id' => 'nullable|integer|exists:usuarios,id',
            'descripcion' => 'required|string',
        ]);

        // Asignar valor por defecto a usuario_id si no se proporciona
        $usuario_id = $request->input('usuario_id', 1);

        // Crear la nueva auditoría
        $auditoria = Auditoria::create([
            'envio_id' => $request->input('envio_id'),
            'usuario_id' => $usuario_id,
            'descripcion' => $request->input('descripcion'),
        ]);

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Auditoría creada',
                'detail' => 'La auditoría se creó correctamente.',
            ],
            'data' => $auditoria
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $auditoria = Auditoria::findOrFail($id);

        // Validación para los campos, permitiendo algunos opcionales
        $validatedData = $request->validate([
            'envio_id' => 'sometimes|integer|exists:envios,id',
            'usuario_id' => 'sometimes|integer|exists:usuarios,id',
            'descripcion' => 'sometimes|string',
        ]);

        // Actualizar solo los campos que están presentes en la solicitud
        $auditoria->update($validatedData);

        return response()->json([
            'msg' => [
                'summary' => 'Auditoría actualizada',
                'detail' => 'La auditoría se actualizó correctamente.',
            ],
            'data' => $auditoria
        ]);
    }

    public function destroy($id)
    {
        // Buscar la auditoría por su ID
        $auditoria = Auditoria::findOrFail($id);

        // Eliminar la auditoría
        $auditoria->delete();

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Auditoría eliminada',
                'detail' => 'La auditoría se eliminó correctamente.',
            ],
            'data' => $auditoria
        ]);
    }
}
