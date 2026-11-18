@extends('layouts.app')

@section('titulo', 'Inicio · Sonora')

@section('contenido')
<script>window.pistas = @json($pistas);</script>

<div class="mb-6 flex flex-wrap gap-2">
    <a href="{{ route('inicio', ['categoria' => 'todo']) }}" class="rounded-pill focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
        <x-chip :activo="$categoria === 'todo'">Todo</x-chip>
    </a>
    <a href="{{ route('inicio', ['categoria' => 'musica']) }}" class="rounded-pill focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
        <x-chip :activo="$categoria === 'musica'">Música</x-chip>
    </a>
    <a href="{{ route('inicio', ['categoria' => 'podcasts']) }}" class="rounded-pill focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
        <x-chip :activo="$categoria === 'podcasts'">Podcasts</x-chip>
    </a>
</div>

<h1 class="mb-4 text-2xl font-extrabold tracking-tight md:text-3xl">Buenas tardes</h1>
<div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
    @foreach ($playlists as $p)
        <a href="{{ route('playlist', $p) }}" class="block rounded-md focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
            <x-media-card :titulo="$p->titulo" :artista="$p->artista" :duracion="$p->duracion" :barras="$p->barras" />
        </a>
    @endforeach
</div>

<h2 class="mb-4 mt-8 text-xl font-bold">En cola</h2>
<div class="max-w-lg rounded-md bg-surface-raised p-2">
    @foreach ($pistas as $i => $pista)
        <x-song-row :indice="$i" :pista="$pista" :actual="$i === 0" />
    @endforeach
</div>
@endsection