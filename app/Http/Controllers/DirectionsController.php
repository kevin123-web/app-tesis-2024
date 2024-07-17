<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DirectionsService;

class DirectionsController extends Controller
{
    protected $directionsService;

    public function __construct(DirectionsService $directionsService)
    {
        $this->directionsService = $directionsService;
    }

    public function store(Request $request)
    {
        // Validar la entrada
        $request->validate([
            'origin' => 'required|string|max:250',
            'destination' => 'required|string|max:250',
        ]);

        // Llamar al servicio para obtener y almacenar la dirección
        $ruta = $this->directionsService->getAndStoreDirections(
            $request->input('origin'),
            $request->input('destination')
        );

        if (!$ruta) {
            return response()->json(['msg' => 'No se encontraron rutas'], 404);
        }

        return response()->json([
            'msg' => 'Ruta creada exitosamente',
            'data' => $ruta
        ], 201);
    }
}
