<?php 

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Models\UbicacionDestino;
use App\Models\UbicacionOrigen;
use App\Models\Ruta;

class DirectionsService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('DIRECTIONS_API_KEY');
    }

    public function getAndStoreDirections($origin, $destination)
    {
        try {
            // Hacer la solicitud a la Directions API
            $response = $this->client->get('https://maps.googleapis.com/maps/api/directions/json', [
                'query' => [
                    'origin' => $origin,
                    'destination' => $destination,
                    'key' => $this->apiKey,
                ],
            ]);

            $data = json_decode($response->getBody(), true);
            
            // Verificar que hay rutas disponibles
            if (empty($data['routes'])) {
                return null; // No se encontraron rutas
            }

            // Obtener coordenadas de origen
            $originLocation = $data['routes'][0]['legs'][0]['start_location'];
            $ubicacionOrigen = UbicacionOrigen::create([
                'nombre' => $origin,
                'latitud' => $originLocation['lat'],
                'longitud' => $originLocation['lng'],
            ]);

            // Obtener coordenadas de destino
            $destinationLocation = $data['routes'][0]['legs'][0]['end_location'];
            $ubicacionDestino = UbicacionDestino::create([
                'nombre' => $destination,
                'latitud' => $destinationLocation['lat'],
                'longitud' => $destinationLocation['lng'],
            ]);

            // Guardar la ruta
            $ruta = Ruta::create([
                'ubicacion_origen_id' => $ubicacionOrigen->id,
                'ubicacion_destino_id' => $ubicacionDestino->id,
                'distancia' => $data['routes'][0]['legs'][0]['distance']['text'],
                'duracion' => $data['routes'][0]['legs'][0]['duration']['text'],
            ]);

            return $ruta; // Devolver la ruta creada

        } catch (RequestException $e) {
            // Manejo de errores de la solicitud
            return null; // O lanzar una excepción personalizada si es necesario
        }
    }
}
