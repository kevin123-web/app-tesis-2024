<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;


class PersonaController extends Controller
{
    public function index()
    {
        $personas = Persona::get();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta de la asignación',
                    'detail' => 'La asignación se consulto  correctamente',
                ],
                'data' => $personas
            ]
        );
    }

    public function show($id)
    {
        $personas = Persona::find($id);
        if (!$personas) {
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
            'data' => $personas
        ]);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'tipo_identificacion_id' => 'required|integer|exists:tipo_identificacion,id',
            'nombre' => 'required|string',
            'cedula' => 'required|string|max:10',
            'email' => 'required|email',
            'Sexo' => 'required|string',
            'direccion' => 'required|string',
            'celular' => 'required|string|max:10',
        ]);

        // Crear la nueva asignación
        $personas = Persona::create([
            'tipo_identificacion_id' => $request->input('tipo_identificacion_id'),
            'nombre' => $request->input('nombre'),
            'cedula' => $request->input('cedula'),
            'email' => $request->input('email'),
            'Sexo' => $request->input('Sexo'),
            'direccion' => $request->input('direccion'),
            'celular' => $request->input('celular'),
        ]);

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Asignación creada',
                'detail' => 'La asignación se creó correctamente',
            ],
            'data' => $personas
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $personas = Persona::findOrFail($id);

        // Validación para todos los campos, pero permitiendo que algunos sean opcionales
        $validatedData = $request->validate([
            'tipo_identificacion_id' => 'sometimes|integer|exists:tipo_identificacion,id',
            'nombre' => 'sometimes|string',
            'cedula' => 'sometimes|string|max:10',
            'email' => 'sometimes|email',
            'Sexo' => 'sometimes|string',
            'direccion' => 'sometimes|string',
            'celular' => 'sometimes|string|max:10',
        ]);

        // Actualizar solo los campos que están presentes en la solicitud
        $personas->update($validatedData);

        return response()->json([
            'msg' => [
                'summary' => 'Actualización de la asignación',
                'detail' => 'La asignación se actualizó correctamente',
            ],
            'data' => $personas
        ]);
    }

    public function destroy($id)
    {
        // Buscar la asignación por su ID
        $personas = Persona::findOrFail($id);

        // Eliminar la asignación
        $personas->delete();

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Asignación eliminada',
                'detail' => 'La asignación se eliminó correctamente',
            ],
            'data' => $personas
        ]);
    }
}
