<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Factura;


class FacturaController extends Controller
{
    public function index()
    {
        $facturas = Factura::get();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta de la asignación',
                    'detail' => 'La asignación se consulto  correctamente',
                ],
                'data' => $facturas
            ]
        );
    }

    public function show($id)
    {
        $facturas = Factura::find($id);
        if (!$facturas) {
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
            'data' => $facturas
        ]);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'cliente_id' => 'required|integer|exists:cliente,id',
            'envio_id' => 'required|integer|exists:envios,id',
            'estado_id' => 'required|integer|exists:estado,id',
            'tipo_pago_id' => 'required|integer|exists:tipo_pago,id',
            'fecha' => 'required|date',
            'subtotal' => 'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
            'total' => 'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
            'con_iva' => 'required|boolean',
            'servicio' => 'required|boolean',
        ]);

        // Crear la nueva asignación
        $facturas = Factura::create([
            'cliente_id' => $request->input('cliente_id'),
            'envio_id' => $request->input('envio_id'),
            'estado_id' => $request->input('estado_id'),
            'tipo_pago_id' => $request->input('tipo_pago_id'),
            'fecha' => $request->input('fecha'),
            'subtotal' => $request->input('subtotal'),
            'total' => $request->input('total'),
            'con_iva' => $request->input('con_iva'),
            'servicio' => $request->input('servicio'),
        ]);

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Asignación creada',
                'detail' => 'La asignación se creó correctamente',
            ],
            'data' => $facturas
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $facturas = Factura::findOrFail($id);

        // Validación para todos los campos, pero permitiendo que algunos sean opcionales
        $validatedData = $request->validate([
            'cliente_id' => 'required|integer|exists:cliente,id',
            'envio_id' => 'required|integer|exists:envios,id',
            'estado_id' => 'required|integer|exists:estado,id',
            'tipo_pago_id' => 'required|integer|exists:tipo_pago,id',
            'fecha' => 'required|date',
            'subtotal' => 'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
            'total' => 'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
            'con_iva' => 'required|boolean',
            'servicio' => 'required|boolean',
        ]);

        // Actualizar solo los campos que están presentes en la solicitud
        $facturas->update($validatedData);

        return response()->json([
            'msg' => [
                'summary' => 'Actualización de la asignación',
                'detail' => 'La asignación se actualizó correctamente',
            ],
            'data' => $facturas
        ]);
    }

    public function destroy($id)
    {
        // Buscar la asignación por su ID
        $facturas = Factura::findOrFail($id);

        // Eliminar la asignación
        $facturas->delete();

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Asignación eliminada',
                'detail' => 'La asignación se eliminó correctamente',
            ],
            'data' => $facturas
        ]);
    }
}
