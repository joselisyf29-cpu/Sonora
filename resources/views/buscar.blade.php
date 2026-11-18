@extends('layouts.app')

@section('titulo', 'Buscar · Sonora')

@section('contenido')
<script>window.pistas = @json($pistas);</script>

<h1 class="mb-4 text-2xl font-extrabold tracking-tight md:text-3xl">Buscar</h1>

<form method="GET" action="{{ route('buscar') }}" class="mb-8 flex max-w-xl items-center gap-3">
    <label for="campo-busqueda" class="sr-only">Buscar canciones, artistas o playlists</label>
    <input id="campo-busqueda" name="q" type="search" value="{{ $q }}" placeholder="Qué quieres escuchar"
        class="w-full rounded-pill border-2 border-line-strong bg-surface-raised px-5 py-3 text-sm font-medium text-ink placeholder:text-ink-muted focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
    <x-button type="submit" variant="primary">Buscar</x-button>
</form>

@if ($playlists->isEmpty() && $pistas->isEmpty())
    <div class="rounded-md bg-surface-raised p-6">
        <p class="text-base font-bold">Sin resultados para "{{ $q }}"</p>
        <p class="mt-1 text-sm font-medium text-ink-muted">Prueba con otro título, artista o álbum.</p>
    </div>
@else
    @if ($playlists->isNotEmpty())
        <h2 class="mb-4 text-xl font-bold">Playlists</h2>
        <div class="mb-8 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($playlists as $p)
                <a href="{{ route('playlist', $p) }}" class="block rounded-md focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
                    <x-media-card :titulo="$p->titulo" :artista="$p->artista" :duracion="$p->duracion" :barras="$p->barras" />
                </a>
            @endforeach
        </div>
    @endif

    @if ($pistas->isNotEmpty())
        <h2 class="mb-4 text-xl font-bold">Canciones</h2>
        <div class="max-w-2xl rounded-md bg-surface-raised p-2">
            @foreach ($pistas as $i => $pista)
                <x-song-row :indice="$i" :pista="$pista" :actual="$i === 0" />
            @endforeach
        </div>
    @endif
@endif
@endsection