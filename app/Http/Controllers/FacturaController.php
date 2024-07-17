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
                    'summary' => 'Lista de facturas',
                    'detail' => 'Se consultaron las facturas correctamente.',
                ],
                'data' => $facturas
            ]
        );
    }

    public function show($id)
    {
        $factura = Factura::find($id);
        if (!$factura) {
            return response()->json([
                'msg' => [
                    'summary' => 'Factura no encontrada',
                    'detail' => 'No se encontró una factura con el ID proporcionado.',
                ],
                'data' => null
            ], 404);
        }
    
        return response()->json([
            'msg' => [
                'summary' => 'Detalles de la factura',
                'detail' => 'Se consultaron los detalles de la factura correctamente.',
            ],
            'data' => $factura
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

        // Crear la nueva factura
        $factura = Factura::create([
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
                'summary' => 'Factura creada',
                'detail' => 'La factura se creó correctamente.',
            ],
            'data' => $factura
        ], 201);
    }

    public function update(Request $request, $id)
    {
        // Buscar la factura por su ID
        $factura = Factura::findOrFail($id);

        // Validación para todos los campos
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

        // Actualizar la factura con los datos proporcionados
        $factura->update($validatedData);

        return response()->json([
            'msg' => [
                'summary' => 'Factura actualizada',
                'detail' => 'La factura se actualizó correctamente.',
            ],
            'data' => $factura
        ]);
    }

    public function destroy($id)
    {
        // Buscar la factura por su ID
        $factura = Factura::findOrFail($id);

        // Eliminar la factura
        $factura->delete();

        // Retornar la respuesta en formato JSON
        return response()->json([
            'msg' => [
                'summary' => 'Factura eliminada',
                'detail' => 'La factura se eliminó correctamente.',
            ],
            'data' => $factura
        ]);
    }
}
