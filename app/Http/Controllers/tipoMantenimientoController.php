<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tipoMantenimiento;


class tipoMantenimientoController extends Controller
{
    public function index()
    {
        $tiposMantenimiento = tipoMantenimiento::all();
        return response()->json([
            'msg' => [
                'summary' => 'Consulta de tipos de mantenimiento',
                'detail' => 'Los tipos de mantenimiento se consultaron correctamente.',
            ],
            'data' => $tiposMantenimiento
        ]);
    }

    public function show($id)
    {
        $tipoMantenimiento = tipoMantenimiento::find($id);
        if (!$tipoMantenimiento) {
            return response()->json([
                'msg' => [
                    'summary' => 'Tipo de mantenimiento no encontrado',
                    'detail' => 'No se encontró el tipo de mantenimiento con el ID proporcionado.',
                ],
                'data' => null
            ], 404);
        }
    
        return response()->json([
            'msg' => [
                'summary' => 'Consulta de tipo de mantenimiento',
                'detail' => 'El tipo de mantenimiento se consultó correctamente.',
            ],
            'data' => $tipoMantenimiento
        ]);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required|string',
        ]);

        // Crear el nuevo tipo de mantenimiento
        $tipoMantenimiento = tipoMantenimiento::create([
            'nombre' => $request->input('nombre'),
        ]);

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Tipo de mantenimiento creado',
                'detail' => 'El tipo de mantenimiento se creó correctamente.',
            ],
            'data' => $tipoMantenimiento
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $tipoMantenimiento = tipoMantenimiento::findOrFail($id);

        // Validación para campos opcionales
        $validatedData = $request->validate([
            'nombre' => 'sometimes|string',
        ]);

        // Actualizar solo los campos que están presentes en la solicitud
        $tipoMantenimiento->update($validatedData);

        return response()->json([
            'msg' => [
                'summary' => 'Tipo de mantenimiento actualizado',
                'detail' => 'El tipo de mantenimiento se actualizó correctamente.',
            ],
            'data' => $tipoMantenimiento
        ]);
    }

    public function destroy($id)
    {
        // Buscar el tipo de mantenimiento por su ID
        $tipoMantenimiento = tipoMantenimiento::findOrFail($id);

        // Eliminar el tipo de mantenimiento
        $tipoMantenimiento->delete();

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Tipo de mantenimiento eliminado',
                'detail' => 'El tipo de mantenimiento se eliminó correctamente.',
            ],
            'data' => $tipoMantenimiento
        ]);
    }
}
