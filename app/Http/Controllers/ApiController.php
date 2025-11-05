<?php

namespace App\Http\Controllers;

use App\Services\PexelsService;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function getLoginCarouselHtml()
    {
        $pexelsService = new PexelsService();
        $response = $pexelsService->getPexelsImages();
        $json = $response->getData(true);

        if (isset($json['error'])) {
            return response()->json(['error' => $json['error']], 400);
        }

        if (!isset($json['photos']) || empty($json['photos'])) {
            return response()->json(['error' => 'No se encontraron imágenes.'], 404);
        }

        $imagenes = $json['photos'];

        $carouselItems = '';
        $carouselIndicators = '';

        foreach ($imagenes as $index => $imagen) {
            $activeClass = $index === 0 ? "active" : "";

            $carouselItems .= "
                <div class='carousel-item $activeClass' data-bs-interval='5000'>
                    <img src='{$imagen['src']}' class='d-block w-100' alt='{$imagen['alt']}'>
                    <div class='carousel-caption d-none d-md-block text-white'>
                        <h5>
                            <a href='{$imagen['photographer_url']}' class='text-white' target='_blank'>
                                {$imagen['photographer']}
                            </a>
                        </h5>
                        <p>{$imagen['alt']}</p>
                    </div>
                </div>
            ";

            $carouselIndicators .= "
                <button type='button' data-bs-target='#carouselExample' data-bs-slide-to='{$index}' class='{$activeClass}' aria-label='Slide " . ($index + 1) . "'></button>
            ";
        }

        // HTML del contenido del carrusel
        $carouselHtml = "
            <div class='carousel-indicators'>{$carouselIndicators}</div>
            <div class='carousel-inner'>{$carouselItems}</div>
            <button class='carousel-control-prev' type='button' data-bs-target='#carouselExample' data-bs-slide='prev'>
                <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                <span class='visually-hidden'>Anterior</span>
            </button>
            <button class='carousel-control-next' type='button' data-bs-target='#carouselExample' data-bs-slide='next'>
                <span class='carousel-control-next-icon' aria-hidden='true'></span>
                <span class='visually-hidden'>Siguiente</span>
            </button>
        ";

        return response()->json(['html' => $carouselHtml]);
    }
}
