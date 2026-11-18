<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Track;
use Illuminate\Http\Request;

class MusicaController extends Controller
{
    public function inicio(Request $request)
    {
        $categoria = $request->query('categoria', 'todo');

        $consulta = Playlist::query();
        if (in_array($categoria, ['musica', 'podcasts'])) {
            $consulta->where('categoria', $categoria);
        }

        $playlists = $consulta->get();
        $pistas = Track::take(5)->get();

        return view('inicio', compact('playlists', 'pistas', 'categoria'));
    }

    public function playlist(Playlist $playlist)
    {
        $playlist->load('tracks');
        $pistas = $playlist->tracks;

        return view('playlist', compact('playlist', 'pistas'));
    }

    public function reproductor()
    {
        $pistas = Track::all();

        return view('reproductor', compact('pistas'));
    }

    public function buscar(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        if ($q !== '') {
            $pistas = Track::where('titulo', 'like', "%{$q}%")
                ->orWhere('artista', 'like', "%{$q}%")
                ->orWhere('album', 'like', "%{$q}%")
                ->get();

            $playlists = Playlist::where('titulo', 'like', "%{$q}%")
                ->orWhere('artista', 'like', "%{$q}%")
                ->get();
        } else {
            $pistas = Track::all();
            $playlists = Playlist::all();
        }

        return view('buscar', compact('pistas', 'playlists', 'q'));
    }
}