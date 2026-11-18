@extends('layouts.app')

@section('titulo', $playlist->titulo . ' · Sonora')

@section('contenido')
<script>window.pistas = @json($pistas);</script>

<div class="mb-6">
    <a href="{{ route('inicio') }}" class="inline-flex items-center gap-2 rounded-pill px-3 py-1.5 text-xs font-bold text-ink-muted hover:bg-surface-high hover:text-ink focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
        Volver a inicio
    </a>
</div>

<div class="mb-8 flex flex-col gap-6 rounded-md bg-surface-raised p-6 md:flex-row md:items-end">
    <div class="flex aspect-square w-40 shrink-0 items-end gap-1.5 rounded-md bg-surface-high p-5 md:w-48">
        @foreach ($playlist->barras as $h)
            <i class="flex-1 rounded-pill bg-accent" style="height: {{ $h }}%"></i>
        @endforeach
    </div>

    <div class="flex-1">
        <p class="text-xs font-bold uppercase tracking-wider text-ink-muted">{{ $playlist->categoria }}</p>
        <h1 class="mt-2 text-3xl font-extrabold tracking-tight md:text-4xl">{{ $playlist->titulo }}</h1>
        <p class="mt-2 text-sm font-medium text-ink-muted">
            {{ $playlist->artista }} · <span class="font-mono">{{ $pistas->count() }} pistas · {{ $playlist->duracion }}</span>
        </p>

        <div class="mt-6 flex flex-wrap items-center gap-3">
            <x-button variant="primary" data-accion="reproducir-lista">Reproducir</x-button>
            <x-button variant="secondary" id="btn-guardar-lista" aria-pressed="false">Guardar en biblioteca</x-button>
        </div>
    </div>
</div>

<div class="rounded-md bg-surface-raised p-3 md:p-4">
    <div class="mb-2 hidden grid-cols-[24px_1fr_1fr_auto] gap-3 border-b border-line px-2 pb-2 text-xs font-bold uppercase tracking-wider text-ink-muted md:grid">
        <span>#</span>
        <span>Título</span>
        <span>Álbum</span>
        <span>Duración</span>
    </div>

    @foreach ($pistas as $i => $pista)
        <x-song-row :indice="$i" :pista="$pista" :actual="$i === 0" />
    @endforeach
</div>
@endsection