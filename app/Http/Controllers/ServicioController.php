<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;


class ServicioController extends Controller
{
    public function index()
    {
        $servicios = Servicio::all();
        return response()->json([
            'msg' => [
                'summary' => 'Consulta de servicios',
                'detail' => 'Los servicios se consultaron correctamente.',
            ],
            'data' => $servicios
        ]);
    }

    public function show($id)
    {
        $servicio = Servicio::find($id);
        if (!$servicio) {
            return response()->json([
                'msg' => [
                    'summary' => 'Servicio no encontrado',
                    'detail' => 'No se encontró el servicio con el ID proporcionado.',
                ],
                'data' => null
            ], 404);
        }
    
        return response()->json([
            'msg' => [
                'summary' => 'Consulta de servicio',
                'detail' => 'El servicio se consultó correctamente.',
            ],
            'data' => $servicio
        ]);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required|string',
        ]);

        // Crear el nuevo servicio
        $servicio = Servicio::create([
            'nombre' => $request->input('nombre'),
        ]);

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Servicio creado',
                'detail' => 'El servicio se creó correctamente.',
            ],
            'data' => $servicio
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $servicio = Servicio::findOrFail($id);

        // Validación para campos opcionales
        $validatedData = $request->validate([
            'nombre' => 'sometimes|string',
        ]);

        // Actualizar solo los campos que están presentes en la solicitud
        $servicio->update($validatedData);

        return response()->json([
            'msg' => [
                'summary' => 'Servicio actualizado',
                'detail' => 'El servicio se actualizó correctamente.',
            ],
            'data' => $servicio
        ]);
    }

    public function destroy($id)
    {
        // Buscar el servicio por su ID
        $servicio = Servicio::findOrFail($id);

        // Eliminar el servicio
        $servicio->delete();

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Servicio eliminado',
                'detail' => 'El servicio se eliminó correctamente.',
            ],
            'data' => $servicio
        ]);
    }
}
