<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notificaciones;
class NotificacionesController extends Controller
{
    public function index()
    {
        $notificaciones = Notificaciones::get();
        return response()->json([
            'msg' => [
                'summary' => 'Consulta de notificaciones',
                'detail' => 'Las notificaciones se consultaron correctamente.',
            ],
            'data' => $notificaciones
        ]);
    }

    public function show($id)
    {
        $notificacion = Notificaciones::find($id);
        if (!$notificacion) {
            return response()->json([
                'msg' => [
                    'summary' => 'Notificación no encontrada',
                    'detail' => 'No se encontró la notificación con el ID proporcionado.',
                ],
                'data' => null
            ], 404);
        }
    
        return response()->json([
            'msg' => [
                'summary' => 'Consulta de notificación',
                'detail' => 'La notificación se consultó correctamente.',
            ],
            'data' => $notificacion
        ]);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'estado' => 'required|boolean',
            'enviado_whatsapp' => 'required|boolean',
        ]);

        // Crear la nueva notificación
        $notificacion = Notificaciones::create([
            'titulo' => $request->input('titulo'),
            'descripcion' => $request->input('descripcion'),
            'estado' => $request->input('estado'),
            'enviado_whatsapp' => $request->input('enviado_whatsapp'),
        ]);

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Notificación creada',
                'detail' => 'La notificación se creó correctamente.',
            ],
            'data' => $notificacion
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $notificacion = Notificaciones::findOrFail($id);

        // Validación para todos los campos, permitiendo algunos opcionales
        $validatedData = $request->validate([
            'titulo' => 'sometimes|string|max:255',
            'descripcion' => 'sometimes|string',
            'estado' => 'sometimes|boolean',
            'enviado_whatsapp' => 'sometimes|boolean',
        ]);

        // Actualizar solo los campos que están presentes en la solicitud
        $notificacion->update($validatedData);

        return response()->json([
            'msg' => [
                'summary' => 'Notificación actualizada',
                'detail' => 'La notificación se actualizó correctamente.',
            ],
            'data' => $notificacion
        ]);
    }

    public function destroy($id)
    {
        // Buscar la notificación por su ID
        $notificacion = Notificaciones::findOrFail($id);

        // Eliminar la notificación
        $notificacion->delete();

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Notificación eliminada',
                'detail' => 'La notificación se eliminó correctamente.',
            ],
            'data' => $notificacion
        ]);
    }
}
