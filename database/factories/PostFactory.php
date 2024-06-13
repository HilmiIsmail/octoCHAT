<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Obtener todas las imágenes de la carpeta 'public/storage/posts'
        $imagenes = collect(File::files(public_path('storage/posts')))
            ->map(function ($file) {
                return 'posts/' . $file->getFilename();
            })
            ->toArray();

        return [
            'contenido' => fake()->text(10),
            'estado' => fake()->randomElement(['PUBLICADO', 'ARCHIVADO']),
            // Seleccionar una imagen aleatoria de la lista
            'imagen' => fake()->randomElement($imagenes),
            'user_id' => User::all()->random()->id,
        ];
    }
}
