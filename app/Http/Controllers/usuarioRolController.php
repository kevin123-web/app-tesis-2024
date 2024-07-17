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
                    'summary' => 'Consulta de roles de usuario',
                    'detail' => 'Los roles de usuario se consultaron correctamente.',
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
                    'summary' => 'Rol de usuario no encontrado',
                    'detail' => 'No se encontró la asignación con el ID proporcionado.',
                ],
                'data' => null
            ], 404);
        }
    
        return response()->json([
            'msg' => [
                'summary' => 'Consulta de rol de usuario',
                'detail' => 'La asignación se consultó correctamente.',
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
                'summary' => 'Rol de usuario creado',
                'detail' => 'La asignación se creó correctamente.',
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
                'summary' => 'Rol de usuario actualizado',
                'detail' => 'La asignación se actualizó correctamente.',
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
                'summary' => 'Rol de usuario eliminado',
                'detail' => 'La asignación se eliminó correctamente.',
            ],
            'data' => $usuario_rol
        ]);
    }
}
