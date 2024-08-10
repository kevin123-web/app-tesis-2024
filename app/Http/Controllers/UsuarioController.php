<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Usuario;
use Illuminate\Validation\ValidationException;


class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::get();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta de usuarios',
                    'detail' => 'Los usuarios se consultaron correctamente.',
                ],
                'data' => $usuarios
            ]
        );
    }

    public function show($id)
    {
        $usuarios = Usuario::find($id);
        if (!$usuarios) {
            return response()->json([
                'msg' => [
                    'summary' => 'Usuario no encontrado',
                    'detail' => 'No se encontró el usuario con el ID proporcionado.',
                ],
                'data' => null
            ], 404);
        }
    
        return response()->json([
            'msg' => [
                'summary' => 'Consulta de usuario',
                'detail' => 'El usuario se consultó correctamente.',
            ],
            'data' => $usuarios
        ]);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'rol_id' => 'required|integer|exists:rol,id',
            'departamento_id' => 'required|integer|exists:departamento,id',
            'nombre_usuario' => 'required|string',
            'nombre' => 'required|string|max:50',
            'email' => 'required|email',
            'contrasena' => 'required|string',
        ]);

        // Crear la nueva asignación
        $usuarios = Usuario::create([
            'rol_id' => $request->input('rol_id'),
            'departamento_id' => $request->input('departamento_id'),
            'nombre_usuario' => $request->input('nombre_usuario'),
            'nombre' => $request->input('nombre'),
            'email' => $request->input('email'),
            'contrasena' => Hash::make($request->input('contrasena'))       
         ]);

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Usuario creado',
                'detail' => 'El usuario se creó correctamente.',
            ],
            'data' => $usuarios
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $usuarios = Usuario::findOrFail($id);

        // Validación para todos los campos, pero permitiendo que algunos sean opcionales
        $validatedData = $request->validate([
            'rol_id' => 'sometimes|integer|exists:rol,id',
            'departamento_id' => 'required|integer|exists:departamento,id',
            'nombre_usuario' => 'sometimes|string',
            'nombre' => 'sometimes|string|max:50',
            'email' => 'sometimes|email',
            'contrasena' => 'sometimes|string',
        ]);

        // Actualizar solo los campos que están presentes en la solicitud
        $usuarios->update($validatedData);

        return response()->json([
            'msg' => [
                'summary' => 'Usuario actualizado',
                'detail' => 'El usuario se actualizó correctamente.',
            ],
            'data' => $usuarios
        ]);
    }

    public function destroy($id)
    {
        // Buscar la asignación por su ID
        $usuarios = Usuario::findOrFail($id);

        // Eliminar la asignación
        $usuarios->delete();

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Usuario eliminado',
                'detail' => 'El usuario se eliminó correctamente.',
            ],
            'data' => $usuarios
        ]);
    }

    public function login(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'nombre_usuario' => 'required|string',
            'contrasena' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => [
                    'summary' => 'Datos inválidos',
                    'detail' => 'Los datos proporcionados son incorrectos.',
                ],
                'data' => null
            ], 400);
        }

        // Buscar al usuario por nombre_usuario
        $usuario = Usuario::where('nombre_usuario', $request->input('nombre_usuario'))->first();

        if (!$usuario || !Hash::check($request->input('contrasena'), $usuario->contrasena)) {
            return response()->json([
                'msg' => [
                    'summary' => 'Autenticación fallida',
                    'detail' => 'Nombre de usuario o contraseña incorrectos.',
                ],
                'data' => null
            ], 401);
        }

        // Devolver los datos del usuario junto con el rol
        return response()->json([
            'msg' => [
                'summary' => 'Inicio de sesión exitoso',
                'detail' => 'El usuario ha iniciado sesión correctamente.',
            ],
            'data' => [
                'usuario' => $usuario,
                'rol' => $usuario->rol_id, // Asumiendo que `rol_id` es el rol del usuario
            ]
        ]);
    }
}
