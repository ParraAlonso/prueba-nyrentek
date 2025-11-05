<?php

namespace Database\Seeders;

use App\Models\Catalogos\Estatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class EstatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arr_estatus = [
            'borrador'=>'#778cb0',
            'pendiente'=>'#00a9c6',
            'en curso'=>'#F0E68C',
            'concluida'=>'#CD5C5C'
        ];

        $cssContent = '';

        foreach ($arr_estatus as $estatus=>$color) {
            Estatus::updateOrCreate([
                'codigo' => Str::slug($estatus),
                'nombre' => ucfirst($estatus)
            ]);
            $cssContent .= ".estatus-".Str::slug($estatus)." { color: {$color} !important; }" . PHP_EOL;
            $cssContent .= ".text-".Str::slug($estatus)." { color: {$color}; }" . PHP_EOL;
            $cssContent .= ".bg-".Str::slug($estatus)." { background-color: {$color}; }" . PHP_EOL;
        }

        //Valida que no exista el directorio publi/css
        if(!File::exists(public_path('css'))){
            File::makeDirectory(public_path('css'));
        }
        //Agrega archivo colores.css
        File::put(public_path('css/colores.css'), $cssContent);
    }
}
