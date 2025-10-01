<?php

namespace Database\Seeders;

use App\Models\PiezaLego;
use Illuminate\Database\Seeder;

class PiezaLegoSeeder extends Seeder
{
    public function run(): void
    {
        $piezas = [
            [
                'nombre' => 'Casa Papa Noel',
                'descripcion' => 'Oficina de Correos de Papa Noel',
                'precio' => 100.00
            ],
            [
                'nombre' => 'Titanic',
                'descripcion' => 'Famoso barco Titinic de lego',
                'precio' => 600.00
            ],
            [
                'nombre' => 'Autobus de batalla',
                'descripcion' => 'Autobus de batalla del juego fornithe',
                'precio' => 100.00
            ],
            [
                'nombre' => 'Torre Eiffel',
                'descripcion' => 'Torre Eiffel de paris',
                'precio' => 620.00
            ],
            [
                'nombre' => 'Radio',
                'descripcion' => 'Radio retro',
                'precio' => 100.00
            ],
            [
                'nombre' => 'Vengadores',
                'descripcion' => 'Torre de los vengadores',
                'precio' => 500.00
            ],
            [
                'nombre' => 'Arbol de navidad',
                'descripcion' => 'Arbol de navidad lego',
                'precio' => 150.00
            ],
            [
                'nombre' => 'Taxi',
                'descripcion' => 'Taxi amarillo',
                'precio' => 10.00
            ],
            [
                'nombre' => 'Museo',
                'descripcion' => 'Museo de historia natural',
                'precio' => 300.00
            ],
            [
                'nombre' => 'Trineo',
                'descripcion' => 'trineo de papa Noel navidad',
                'precio' => 40.00
            ],
            [
                'nombre' => 'Cabina telefono',
                'descripcion' => 'Cabina de telefono roja de Londres',
                'precio' => 115.00
            ],
            [
                'nombre' => 'Groot',
                'descripcion' => 'Groot en maceta',
                'precio' => 10.00
            ],
            [
                'nombre' => 'Jardin',
                'descripcion' => 'Jardin botanico',
                'precio' => 320.00
            ],
            [
                'nombre' => 'Torre',
                'descripcion' => 'Torre del señor de los anillos',
                'precio' => 450.00
            ],
            [
                'nombre' => 'Flores',
                'descripcion' => 'Ramo de flores',
                'precio' => 60.00
            ]
        ];

        foreach ($piezas as $pieza) {
            PiezaLego::create($pieza);
        }
    }
}