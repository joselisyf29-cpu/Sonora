<?php

namespace Database\Seeders;

use App\Models\Playlist;
use App\Models\Track;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $p1 = Playlist::create([
            'titulo' => 'Mezcla diaria 1',
            'artista' => 'Para ti',
            'categoria' => 'musica',
            'duracion' => '17:45',
            'barras' => [45, 75, 50, 88, 40],
        ]);

        $p2 = Playlist::create([
            'titulo' => 'Tarde nublada',
            'artista' => 'Costa Sur',
            'categoria' => 'musica',
            'duracion' => '13:20',
            'barras' => [78, 42, 68, 35, 82],
        ]);

        $p3 = Playlist::create([
            'titulo' => 'En calma',
            'artista' => 'Viento Alto',
            'categoria' => 'musica',
            'duracion' => '10:50',
            'barras' => [52, 84, 38, 72, 64],
        ]);

        $p4 = Playlist::create([
            'titulo' => 'Charlas de medianoche',
            'artista' => 'Podcast original',
            'categoria' => 'podcasts',
            'duracion' => '23:40',
            'barras' => [34, 62, 88, 48, 76],
        ]);

        $pistas = [
            ['playlist_id' => $p1->id, 'titulo' => 'Luces del puerto', 'artista' => 'Costa Sur', 'album' => 'Orilla', 'dur' => 244],
            ['playlist_id' => $p1->id, 'titulo' => 'Alba serena', 'artista' => 'Viento Alto', 'album' => 'Cima', 'dur' => 228],
            ['playlist_id' => $p1->id, 'titulo' => 'Notas de madera', 'artista' => 'Taller Nueve', 'album' => 'Sesión viva', 'dur' => 295],
            ['playlist_id' => $p2->id, 'titulo' => 'Sendero de niebla', 'artista' => 'Costa Sur', 'album' => 'Orilla', 'dur' => 215],
            ['playlist_id' => $p2->id, 'titulo' => 'Hojas secas', 'artista' => 'Valle Claro', 'album' => 'Otoño', 'dur' => 252],
            ['playlist_id' => $p2->id, 'titulo' => 'Marea lenta', 'artista' => 'Costa Sur', 'album' => 'Orilla', 'dur' => 310],
            ['playlist_id' => $p3->id, 'titulo' => 'En calma', 'artista' => 'Viento Alto', 'album' => 'Cima', 'dur' => 276],
            ['playlist_id' => $p3->id, 'titulo' => 'Silencio de lluvia', 'artista' => 'Taller Nueve', 'album' => 'Pausa', 'dur' => 204],
            ['playlist_id' => $p4->id, 'titulo' => 'Episodio 1: Relatos de carretera', 'artista' => 'Charlas de medianoche', 'album' => 'Temporada 1', 'dur' => 725],
            ['playlist_id' => $p4->id, 'titulo' => 'Episodio 2: El fantasma de la escuela', 'artista' => 'Charlas de medianoche', 'album' => 'Temporada 1', 'dur' => 695],
        ];

        foreach ($pistas as $pista) {
            Track::create($pista);
        }
    }
}