<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $categorias = [
            ['nombre' => 'Bares y Restaurantes', 'imagen' => 'storage/categorias/burger.png'],
            ['nombre' => 'Papelerías', 'imagen' => 'storage/categorias/books.png'],
            ['nombre' => 'Hornos', 'imagen' => 'storage/categorias/bread.png'],
            ['nombre' => 'Tecnología', 'imagen' => 'storage/categorias/responsive.png'],
            ['nombre' => 'Supermercados', 'imagen' => 'storage/categorias/food.png'],
        ];

        foreach ($categorias as $categoria) {
            DB::table('categorias')->insert($categoria);
        }
    }
}
