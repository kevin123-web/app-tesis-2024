<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tipoPago;


class tipoPagoController extends Controller
{
    public function index()
    {
        $tiposPago = tipoPago::all();
        return response()->json([
            'msg' => [
                'summary' => 'Consulta de tipos de pago',
                'detail' => 'Los tipos de pago se consultaron correctamente.',
            ],
            'data' => $tiposPago
        ]);
    }

    public function show($id)
    {
        $tipoPago = tipoPago::find($id);
        if (!$tipoPago) {
            return response()->json([
                'msg' => [
                    'summary' => 'Tipo de pago no encontrado',
                    'detail' => 'No se encontró el tipo de pago con el ID proporcionado.',
                ],
                'data' => null
            ], 404);
        }

        return response()->json([
            'msg' => [
                'summary' => 'Consulta de tipo de pago',
                'detail' => 'El tipo de pago se consultó correctamente.',
            ],
            'data' => $tipoPago
        ]);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required|string',
        ]);

        // Crear el nuevo tipo de pago
        $tipoPago = tipoPago::create([
            'nombre' => $request->input('nombre'),
        ]);

        return response()->json([
            'msg' => [
                'summary' => 'Tipo de pago creado',
                'detail' => 'El tipo de pago se creó correctamente.',
            ],
            'data' => $tipoPago
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $tipoPago = tipoPago::findOrFail($id);

        // Validación para campos opcionales
        $validatedData = $request->validate([
            'nombre' => 'sometimes|string',
        ]);

        // Actualizar solo los campos que están presentes en la solicitud
        $tipoPago->update($validatedData);

        return response()->json([
            'msg' => [
                'summary' => 'Tipo de pago actualizado',
                'detail' => 'El tipo de pago se actualizó correctamente.',
            ],
            'data' => $tipoPago
        ]);
    }

    public function destroy($id)
    {
        // Buscar el tipo de pago por su ID
        $tipoPago = tipoPago::findOrFail($id);

        // Eliminar el tipo de pago
        $tipoPago->delete();

        return response()->json([
            'msg' => [
                'summary' => 'Tipo de pago eliminado',
                'detail' => 'El tipo de pago se eliminó correctamente.',
            ],
            'data' => $tipoPago
        ]);
    }
}
