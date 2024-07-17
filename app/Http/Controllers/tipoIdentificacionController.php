<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tipoIdentificacion;


class tipoIdentificacionController extends Controller
{
    public function index()
    {
        $tiposIdentificacion = tipoIdentificacion::all();
        return response()->json([
            'msg' => [
                'summary' => 'Consulta de tipos de identificación',
                'detail' => 'Los tipos de identificación se consultaron correctamente.',
            ],
            'data' => $tiposIdentificacion
        ]);
    }

    public function show($id)
    {
        $tipoIdentificacion = tipoIdentificacion::find($id);
        if (!$tipoIdentificacion) {
            return response()->json([
                'msg' => [
                    'summary' => 'Tipo de identificación no encontrado',
                    'detail' => 'No se encontró el tipo de identificación con el ID proporcionado.',
                ],
                'data' => null
            ], 404);
        }
    
        return response()->json([
            'msg' => [
                'summary' => 'Consulta de tipo de identificación',
                'detail' => 'El tipo de identificación se consultó correctamente.',
            ],
            'data' => $tipoIdentificacion
        ]);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required|string',
        ]);

        // Crear el nuevo tipo de identificación
        $tipoIdentificacion = tipoIdentificacion::create([
            'nombre' => $request->input('nombre'),
        ]);

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Tipo de identificación creado',
                'detail' => 'El tipo de identificación se creó correctamente.',
            ],
            'data' => $tipoIdentificacion
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $tipoIdentificacion = tipoIdentificacion::findOrFail($id);

        // Validación para campos opcionales
        $validatedData = $request->validate([
            'nombre' => 'sometimes|string',
        ]);

        // Actualizar solo los campos que están presentes en la solicitud
        $tipoIdentificacion->update($validatedData);

        return response()->json([
            'msg' => [
                'summary' => 'Tipo de identificación actualizado',
                'detail' => 'El tipo de identificación se actualizó correctamente.',
            ],
            'data' => $tipoIdentificacion
        ]);
    }

    public function destroy($id)
    {
        // Buscar el tipo de identificación por su ID
        $tipoIdentificacion = tipoIdentificacion::findOrFail($id);

        // Eliminar el tipo de identificación
        $tipoIdentificacion->delete();

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Tipo de identificación eliminado',
                'detail' => 'El tipo de identificación se eliminó correctamente.',
            ],
            'data' => $tipoIdentificacion
        ]);
    }
}
