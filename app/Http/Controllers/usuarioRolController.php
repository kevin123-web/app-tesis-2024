<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\usuarioRol;


class usuarioRolController extends Controller
{
    public function index()
    {
        $usuario_rol = usuarioRol::get();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta de la asignación',
                    'detail' => 'La asignación se consulto  correctamente',
                ],
                'data' => $usuario_rol
            ]
        );
    }

    public function show($id)
    {
        $usuario_rol = usuarioRol::find($id);
        if (!$usuario_rol) {
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
            'data' => $usuario_rol
        ]);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'rol_id' => 'required|integer|exists:rol,id',
            'usuario_id' => 'required|integer|exists:usuario,id',

        ]);

        // Crear la nueva asignación
        $usuario_rol = usuarioRol::create([
            'rol_id' => $request->input('rol_id'),
            'usuario_id' => $request->input('usuario_id'),

        ]);

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Asignación creada',
                'detail' => 'La asignación se creó correctamente',
            ],
            'data' => $usuario_rol
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $usuario_rol = usuarioRol::findOrFail($id);

        // Validación para todos los campos, pero permitiendo que algunos sean opcionales
        $validatedData = $request->validate([
            'rol_id' => 'sometimes|integer|exists:rol,id',
            'usuario_id' => 'sometimes|integer|exists:usuario,id',        
        ]);

        // Actualizar solo los campos que están presentes en la solicitud
        $usuario_rol->update($validatedData);

        return response()->json([
            'msg' => [
                'summary' => 'Actualización de la asignación',
                'detail' => 'La asignación se actualizó correctamente',
            ],
            'data' => $usuario_rol
        ]);
    }

    public function destroy($id)
    {
        // Buscar la asignación por su ID
        $usuario_rol = usuarioRol::findOrFail($id);

        // Eliminar la asignación
        $usuario_rol->delete();

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Asignación eliminada',
                'detail' => 'La asignación se eliminó correctamente',
            ],
            'data' => $usuario_rol
        ]);
    }
}
