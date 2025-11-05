<?php

namespace App\Services;

use App\Models\Tarea;
use App\Models\TareaImagen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TareaService
{
    protected $pexelsService;

    public function __construct(PexelsService $pexelsService)
    {
        $this->pexelsService = $pexelsService;
    }

    public function getTareas()
    {
        return Tarea::orderByDesc('id')->paginate(6);
    }

    public function storeTarea($tarea, $request)
    {
        $update = $tarea->exists;

        $tarea->fill([
            'titulo' => $request->titulo,
            'estatus_id' => $request->estatus_id,
            'descripcion' => $request->descripcion,
            'usuario_id' => $tarea->exists ? $tarea->usuario_id : Auth::id(),
        ])->save();

        if (!$update) {
            $this->fetchAndStoreImages($tarea);
        }

        return redirect()
            ->route('tareas.show', $tarea->id)
            ->with('success', $update ? 'Tarea actualizada correctamente' : 'Tarea registrada correctamente');
    }

    private function fetchAndStoreImages(Tarea $tarea)
    {
        try {
            $response = $this->pexelsService->getPexelsImages();
            foreach ($response->getData()->photos as $imagen) {
                $this->storeImage($tarea, $imagen);
            }
        } catch (\Exception $e) {
            Log::error("Error al obtener imágenes de Pexels: " . $e->getMessage());
        }
    }

    private function storeImage(Tarea $tarea, $imagen)
    {
        $imageUrl = $imagen->src;
        $imageContent = Http::get($imageUrl)->body();
        $imageName = basename(parse_url($imageUrl, PHP_URL_PATH));
        $imagePath = "tareas/{$tarea->id}/$imageName";

        Storage::disk('public')->put($imagePath, $imageContent);

        TareaImagen::create([
            'tarea_id' => $tarea->id,
            'ruta_archivo' => $imagePath,
            'url' => $imageUrl,
            'nombre_fotografo' => $imagen->photographer,
            'url_fotografo' => $imagen->photographer_url,
            'descripcion' => $imagen->alt ?? null,
        ]);
    }

    public function deleteTarea(Tarea $tarea)
    {
        $tarea->imagenes()->delete();
        $tarea->delete();
    }

}
