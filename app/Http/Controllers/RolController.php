<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;

class RolController extends Controller
{
    public function index()
    {
        $roles = Rol::all();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta de roles',
                    'detail' => 'Los roles se consultaron correctamente.',
                ],
                'data' => $roles
            ]
        );
    }

    public function show($id)
    {
        $rol = Rol::find($id);
        if (!$rol) {
            return response()->json([
                'msg' => [
                    'summary' => 'Rol no encontrado',
                    'detail' => 'No se encontró el rol con el ID proporcionado.',
                ],
                'data' => null
            ], 404);
        }
    
        return response()->json([
            'msg' => [
                'summary' => 'Consulta de rol',
                'detail' => 'El rol se consultó correctamente.',
            ],
            'data' => $rol
        ]);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        // Crear el nuevo rol
        $rol = Rol::create([
            'nombre' => $request->input('nombre'),
        ]);

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Rol creado',
                'detail' => 'El rol se creó correctamente.',
            ],
            'data' => $rol
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $rol = Rol::findOrFail($id);

        // Validación para los campos, permitiendo algunos opcionales
        $validatedData = $request->validate([
            'nombre' => 'sometimes|string|max:255',
        ]);

        // Actualizar solo los campos que están presentes en la solicitud
        $rol->update($validatedData);

        return response()->json([
            'msg' => [
                'summary' => 'Rol actualizado',
                'detail' => 'El rol se actualizó correctamente.',
            ],
            'data' => $rol
        ]);
    }

    public function destroy($id)
    {
        // Buscar el rol por su ID
        $rol = Rol::findOrFail($id);

        // Eliminar el rol
        $rol->delete();

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Rol eliminado',
                'detail' => 'El rol se eliminó correctamente.',
            ],
            'data' => $rol
        ]);
    }
}
