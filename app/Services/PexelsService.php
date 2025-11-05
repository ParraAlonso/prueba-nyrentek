<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class PexelsService
{
    protected $client;
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * Consulta a la API de Pexels, devuelve un conjunto de imágenes aleatorias.
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getPexelsImages()
    {
        if (!config('services.pexels.api_key')) {
            return response()->json([
                'error' => 'No se ha encontrado una API Key válida de Pexels.',
            ], 400);
        }

        try {
            $randomPage = random_int(1, 50);
            $response = $this->client->get("https://api.pexels.com/v1/search?query=software programming,coding languages,software developers,software design,meetings,tasks&locale=es-ES&page={$randomPage}", [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => config('services.pexels.api_key')
                ]
            ]);

            $result = json_decode((string) $response->getBody(), true);

            if (!isset($result['photos']) || empty($result['photos'])) {
                return response()->json([
                    'error' => 'No se encontraron imágenes.'
                ], 404);
            }

            shuffle($result['photos']);

            $imagenesSeleccionadas = array_slice($result['photos'], 0, 5);

            return response()->json([
                'photos' => array_map(function ($foto) {
                    return [
                        'src' => $foto['src']['landscape'] ?? '',
                        'alt' => $foto['alt'] ?? '',
                        'photographer' => $foto['photographer'] ?? '',
                        'photographer_url' => $foto['photographer_url'] ?? ''
                    ];
                }, $imagenesSeleccionadas)
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'error' => 'Ocurrió un error en el servidor, inténtelo nuevamente.'
            ], 500);
        }
    }
}
