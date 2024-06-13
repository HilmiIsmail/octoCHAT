<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /* Storage::deleteDirectory('public/profile-photos');
        Storage::makeDirectory('public/profile-photos'); */

        //Crear un usuario Admin
        User::factory()->create([
            'name' => 'Ismail Hilmi',
            'email' => 'admin@email.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'isAdmin' => 'SI',
        ]);

        //Crear el resto de Usuarios
        $users = User::factory(6)->create();

        $this->call(TagSeeder::class);

        /* Storage::deleteDirectory('public/posts');
        Storage::makeDirectory('public/posts');
 */

        $this->call(PostSeeder::class);
    }
}
