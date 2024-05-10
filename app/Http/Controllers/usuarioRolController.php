<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\usuarioRol;


class usuarioRolController extends Controller
{
    public function index()
    {
        $usuario_rol = usuarioRol::get();
        return response()->json(
            [
                'msg' => [
                    'summary' => 'Consulta de la asignación',
                    'detail' => 'La asignación se consulto  correctamente',
                ],
                'data' => $usuario_rol
            ]
        );
    }

    public function show($id)
    {
        $usuario_rol = usuarioRol::find($id);
        if (!$usuario_rol) {
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
            'data' => $usuario_rol
        ]);
    }
}
