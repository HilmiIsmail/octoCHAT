<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'tecnología',
            'arte',
            'viajes',
            'moda',
            'comida',
            'deportes',
            'música',
            'cine',
            'naturaleza',
            'literatura',
            'política',
            'ciencia',
            'salud',
            'educación',
            'finanzas',
            'entretenimiento',
            'hogar',
            'humor',
            'fotografía',
        ];
        foreach ($tags as $nombre) {
            Tag::create([
                'nombre' => $nombre,
            ]);
        }
    }
}
