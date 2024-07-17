<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;

class PersonaController extends Controller{

    public function index()
    {
        $personas = Persona::get();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta de personas',
                    'detail' => 'Las personas se consultaron correctamente.',
                ],
                'data' => $personas
            ]
        );
    }

    public function show($id)
    {
        $persona = Persona::find($id);
        if (!$persona) {
            return response()->json([
                'msg' => [
                    'summary' => 'Persona no encontrada',
                    'detail' => 'No se encontró la persona con el ID proporcionado.',
                ],
                'data' => null
            ], 404);
        }
    
        return response()->json([
            'msg' => [
                'summary' => 'Consulta de persona',
                'detail' => 'La persona se consultó correctamente.',
            ],
            'data' => $persona
        ]);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'tipo_identificacion_id' => 'required|integer|exists:tipo_identificacion,id',
            'nombre' => 'required|string|max:255',
            'cedula' => 'required|string|max:10',
            'email' => 'required|email',
            'sexo' => 'required|string',
            'direccion' => 'required|string',
            'celular' => 'required|string|max:10',
        ]);

        // Crear la nueva persona
        $persona = Persona::create([
            'tipo_identificacion_id' => $request->input('tipo_identificacion_id'),
            'nombre' => $request->input('nombre'),
            'cedula' => $request->input('cedula'),
            'email' => $request->input('email'),
            'sexo' => $request->input('sexo'),
            'direccion' => $request->input('direccion'),
            'celular' => $request->input('celular'),
        ]);

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Persona creada',
                'detail' => 'La persona se creó correctamente.',
            ],
            'data' => $persona
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $persona = Persona::findOrFail($id);

        // Validación para todos los campos, permitiendo algunos opcionales
        $validatedData = $request->validate([
            'tipo_identificacion_id' => 'sometimes|integer|exists:tipo_identificacion,id',
            'nombre' => 'sometimes|string|max:255',
            'cedula' => 'sometimes|string|max:10',
            'email' => 'sometimes|email',
            'sexo' => 'sometimes|string',
            'direccion' => 'sometimes|string',
            'celular' => 'sometimes|string|max:10',
        ]);

        // Actualizar solo los campos que están presentes en la solicitud
        $persona->update($validatedData);

        return response()->json([
            'msg' => [
                'summary' => 'Persona actualizada',
                'detail' => 'La persona se actualizó correctamente.',
            ],
            'data' => $persona
        ]);
    }

    public function destroy($id)
    {
        // Buscar la persona por su ID
        $persona = Persona::findOrFail($id);

        // Eliminar la persona
        $persona->delete();

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Persona eliminada',
                'detail' => 'La persona se eliminó correctamente.',
            ],
            'data' => $persona
        ]);
    }

    public function filter(Request $request)
{
    $query = Persona::query();

    // Filtrar por cédula si se proporciona
    if ($request->has('cedula') && $request->input('cedula') != '') {
        $query->where('cedula', 'like', '%' . $request->input('cedula') . '%');
    }

    // Filtrar por nombre si se proporciona
    if ($request->has('nombre') && $request->input('nombre') != '') {
        $query->where('nombre', 'like', '%' . $request->input('nombre') . '%');
    }

    // Obtener los resultados filtrados
    $personas = $query->get();

    return response()->json(
        [
            'msg' => [
                'summary' => 'Consulta filtrada de personas',
                'detail' => 'Las personas se consultaron correctamente según los filtros aplicados.',
            ],
            'data' => $personas
        ]
    );
}

}
