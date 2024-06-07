<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Inserts Categorias
        $categorias = [
            ['nombre' => 'Bares y Restaurantes', 'imagen' => 'burger.png'],
            ['nombre' => 'Papelerías', 'imagen' => 'books.png'],
            ['nombre' => 'Hornos', 'imagen' => 'bread.png'],
            ['nombre' => 'Tecnología', 'imagen' => 'responsive.png'],
            ['nombre' => 'Supermercados', 'imagen' => 'food.png'],
        ];

        $categoriaIds = [];
        foreach ($categorias as $categoria) {
            $categoriaIds[] = DB::table('categorias')->insertGetId($categoria);
        }

        // Inserts Zonas
        $zona = [
            'nombre' => 'Los Valles',
            'provincia' => 'Valencia',
            'comunidad' => 'Comunidad Valenciana',
        ];

        $zonaId = DB::table('zonas')->insertGetId($zona);


        // Inserts Poblaciones
        $poblaciones = [
            ['nombre' => 'Faura', 'codigoPostal' => 46512, 'zona_id' => $zonaId],
            ['nombre' => 'Quartell', 'codigoPostal' => 46510, 'zona_id' => $zonaId],
            ['nombre' => 'Benifairó', 'codigoPostal' => 46511, 'zona_id' => $zonaId],
            ['nombre' => 'Benavites', 'codigoPostal' => 46514, 'zona_id' => $zonaId],
            ['nombre' => 'Quart', 'codigoPostal' => 46515, 'zona_id' => $zonaId],
        ];

        $poblacionIds = [];
        foreach ($poblaciones as $poblacion) {
            $poblacionIds[] = DB::table('poblaciones')->insertGetId($poblacion);
        }


        // Inserts Establecimientos
        $establecimientoNombres = [
            'Bar Aldente Pizzería',
            'Papeleria Sant Roc',
            'Pa i Dolços',
            'Tecnología Quartell',
            'MasyMas',
        ];

        for ($i = 0; $i < count($categoriaIds); $i++) {
            $establecimiento = [
                'nombre' => $establecimientoNombres[$i],
                'poblacion_id' => $poblacionIds[$i],
                'direccion' => 'Calle Falsa 123',
                'imagen' => 'https://via.placeholder.com/150',
                'categoria_id' => $categoriaIds[$i],
                'tiempoPreparacion' => rand(10, 60),
                'telefono' => '123456789',
                'costeEnvio' => rand(1, 10),
            ];

            $establecimientoId = DB::table('establecimientos')->insertGetId($establecimiento);

            $productos = [
                ['nombre' => 'Producto 1', 'descripcion' => 'Descripción del producto 1', 'imagen' => 'https://via.placeholder.com/150', 'precio' => 10.99, 'tamano' => 'pequeno'],
                ['nombre' => 'Producto 2', 'descripcion' => 'Descripción del producto 2', 'imagen' => 'https://via.placeholder.com/150', 'precio' => 15.99, 'tamano' => 'mediano'],
                ['nombre' => 'Producto 3', 'descripcion' => 'Descripción del producto 3', 'imagen' => 'https://via.placeholder.com/150', 'precio' => 20.99, 'tamano' => 'grande'],
            ];

            foreach ($productos as $producto) {
                $producto['establecimiento_id'] = $establecimientoId;

                DB::table('productos')->insert($producto);
            }

        }


        // Inserts Usuarios
        $usuarios = [
            [
                'nombre' => 'Darío Poves',
                'email' => 'dario@poves.com',
                'password' => bcrypt('dario'),
                'telefono' => '123456789',
                'rol' => 'cliente',
            ],
            [
                'nombre' => 'Pepe Pérez',
                'email' => 'pepe@perez.com',
                'password' => bcrypt('pepe'),
                'telefono' => '987654321',
                'rol' => 'cliente',
            ],
            [
                'nombre' => 'Argenis Marrero',
                'email' => 'argenis@marrero.com',
                'password' => bcrypt('duro'),
                'telefono' => '123456789',
                'rol' => 'repartidor',
            ],
            [
                'nombre' => 'Bar Aldente Pizzería',
                'email' => 'aldente@pizzeria.com',
                'password' => bcrypt('ori'),
                'telefono' => '123456789',
                'rol' => 'socio',
                'establecimiento_id' => 1,
            ],
        ];
        
        foreach ($usuarios as $usuario) {
            DB::table('users')->insert($usuario);
        }
    }
}