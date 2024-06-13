<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::factory(17)->create();

        foreach ($posts as $post) {
            $post->tags()->attach(self::getRandomTagsIds());
            $post->likedByUsers()->attach(self::getRandomUsersIds());

            // Generar un número aleatorio de comentarios para este post
            $numComments = rand(1, 5);
            for ($i = 0; $i < $numComments; $i++) {
                // Crear un comentario para el post actual con el usuario aleatorio
                Comment::create([
                    'contenido' => fake()->text(10),
                    'post_id' => $post->id,
                    'user_id' => User::all()->random()->id,
                ]);
            }
        }
    }

    private static function getRandomTagsIds()
    {
        $tags = [];

        // Obtener todos los IDs de los tags en la base de datos
        $idsTags = Tag::pluck('id')->toArray();

        $indicesRand = array_rand($idsTags, random_int(1, count($idsTags)));

        if (!is_array($indicesRand)) {
            // si array_rand() devuelve un solo valor en lugar de un array,
            // conviértelo en un array con un solo elemento
            $indicesRand = [$indicesRand];
        }

        foreach ($indicesRand as $indice) {
            $tags[] = $idsTags[$indice];
        }
        return $tags;
    }

    private static function getRandomUsersIds(): array
    {
        $usuarios = [];

        // Obtener todos los IDs de usuarios en la base de datos
        $idsUsuarios = User::pluck('id')->toArray();

        $indicesRand = array_rand($idsUsuarios, random_int(1, count($idsUsuarios)));

        if (!is_array($indicesRand)) {
            $indicesRand = [$indicesRand];
        } elseif (count($indicesRand) === 0) {
            return $usuarios; // Devolver un array vacío
        }
        foreach ($indicesRand as $indice) {
            $usuarios[] = $idsUsuarios[$indice];
        }

        return $usuarios;
    }
}
