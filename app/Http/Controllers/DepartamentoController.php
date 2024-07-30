<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;

class DepartamentoController extends Controller
{
    public function index()
    {
        $departamentos = Departamento::all();
        return response()->json([
            'msg' => [
                'summary' => 'Consulta de departamentos',
                'detail' => 'Los departamentos se consultaron correctamente.',
            ],
            'data' => $departamentos
        ]);
    }

    public function show($id)
    {
        $departamento = Departamento::find($id);
        if (!$departamento) {
            return response()->json([
                'msg' => [
                    'summary' => 'Departamento no encontrado',
                    'detail' => 'No se encontró el departamento con el ID proporcionado.',
                ],
                'data' => null
            ], 404);
        }

        return response()->json([
            'msg' => [
                'summary' => 'Consulta de departamento',
                'detail' => 'El departamento se consultó correctamente.',
            ],
            'data' => $departamento
        ]);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        // Crear el nuevo departamento
        $departamento = Departamento::create([
            'nombre' => $request->input('nombre'),
        ]);

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Departamento creado',
                'detail' => 'El departamento se creó correctamente.',
            ],
            'data' => $departamento
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $departamento = Departamento::findOrFail($id);

        // Validación para los campos, permitiendo algunos opcionales
        $validatedData = $request->validate([
            'nombre' => 'sometimes|string|max:255',
        ]);

        // Actualizar solo los campos que están presentes en la solicitud
        $departamento->update($validatedData);

        return response()->json([
            'msg' => [
                'summary' => 'Departamento actualizado',
                'detail' => 'El departamento se actualizó correctamente.',
            ],
            'data' => $departamento
        ]);
    }

    public function destroy($id)
    {
        // Buscar el departamento por su ID
        $departamento = Departamento::findOrFail($id);

        // Eliminar el departamento
        $departamento->delete();

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Departamento eliminado',
                'detail' => 'El departamento se eliminó correctamente.',
            ],
            'data' => $departamento
        ]);
    }
}
