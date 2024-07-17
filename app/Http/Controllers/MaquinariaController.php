<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maquinaria;

class MaquinariaController extends Controller
{
    public function index()
    {
        $maquinarias = Maquinaria::get();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta de maquinarias',
                    'detail' => 'Las maquinarias se consultaron correctamente.',
                ],
                'data' => $maquinarias
            ]
        );
    }

    public function show($id)
    {
        $maquinaria = Maquinaria::find($id);
        if (!$maquinaria) {
            return response()->json([
                'msg' => [
                    'summary' => 'Maquinaria no encontrada',
                    'detail' => 'No se encontró la maquinaria con el ID proporcionado.',
                ],
                'data' => null
            ], 404);
        }
    
        return response()->json([
            'msg' => [
                'summary' => 'Consulta de maquinaria',
                'detail' => 'La maquinaria se consultó correctamente.',
            ],
            'data' => $maquinaria
        ]);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        // Crear la nueva maquinaria
        $maquinaria = Maquinaria::create([
            'nombre' => $request->input('nombre'),
        ]);

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Maquinaria creada',
                'detail' => 'La maquinaria se creó correctamente.',
            ],
            'data' => $maquinaria
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $maquinaria = Maquinaria::findOrFail($id);

        // Validación para todos los campos, permitiendo algunos opcionales
        $validatedData = $request->validate([
            'nombre' => 'sometimes|string|max:255',
        ]);

        // Actualizar solo los campos que están presentes en la solicitud
        $maquinaria->update($validatedData);

        return response()->json([
            'msg' => [
                'summary' => 'Maquinaria actualizada',
                'detail' => 'La maquinaria se actualizó correctamente.',
            ],
            'data' => $maquinaria
        ]);
    }

    public function destroy($id)
    {
        // Buscar la maquinaria por su ID
        $maquinaria = Maquinaria::findOrFail($id);

        // Eliminar la maquinaria
        $maquinaria->delete();

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Maquinaria eliminada',
                'detail' => 'La maquinaria se eliminó correctamente.',
            ],
            'data' => $maquinaria
        ]);
    }
}
