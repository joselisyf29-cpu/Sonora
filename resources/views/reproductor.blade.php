@extends('layouts.app')

@section('titulo', 'Sonando ahora · Sonora')

@section('contenido')
<script>window.pistas = @json($pistas);</script>

<div class="mx-auto flex max-w-xl flex-col items-center py-4 text-center md:py-8">
    <p class="mb-6 text-xs font-bold uppercase tracking-wider text-ink-muted">Sonando ahora</p>

    {{-- Portada grande --}}
    <div class="mb-8 flex aspect-square w-64 items-end gap-2.5 rounded-md bg-surface-raised p-8 shadow-raise md:w-72">
        <i class="flex-1 rounded-pill bg-accent" style="height: 48%"></i>
        <i class="flex-1 rounded-pill bg-accent" style="height: 82%"></i>
        <i class="flex-1 rounded-pill bg-accent" style="height: 60%"></i>
        <i class="flex-1 rounded-pill bg-accent" style="height: 92%"></i>
        <i class="flex-1 rounded-pill bg-accent" style="height: 40%"></i>
    </div>

    {{-- Título y artista --}}
    <div class="mb-6 w-full">
        <h1 id="np-titulo" class="text-2xl font-extrabold tracking-tight md:text-3xl">{{ $pistas->first()?->titulo ?? 'Sin pista' }}</h1>
        <p id="np-artista" class="mt-1 text-base font-medium text-ink-muted">{{ $pistas->first()?->artista ?? '' }}</p>
        <p id="np-album" class="mt-1 text-xs font-medium text-ink-muted">{{ $pistas->first()?->album ?? '' }}</p>
    </div>

    {{-- Barra de progreso dedicada --}}
    <div class="mb-6 flex w-full items-center gap-3 font-mono text-xs text-ink-muted">
        <span id="np-tiempo">00:00</span>
        <div tabindex="0" id="np-barra" role="slider" aria-label="Progreso de reproducción" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"
            class="h-2 flex-1 cursor-pointer rounded-pill bg-surface-high focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
            <div id="np-relleno" class="h-2 rounded-pill bg-accent" style="width: 0%"></div>
        </div>
        <span id="np-duracion">00:00</span>
    </div>

    {{-- Controles principales (solo un botón primario ámbar) --}}
    <div class="flex items-center justify-center gap-6">
        <button type="button" id="btn-aleatorio" aria-label="Aleatorio" aria-pressed="false"
            class="rounded-pill p-2.5 text-ink-muted hover:bg-surface-high hover:text-ink aria-pressed:text-accent focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
            <x-icon name="shuffle" />
        </button>

        <button type="button" data-accion="anterior" aria-label="Anterior"
            class="rounded-pill p-2.5 text-ink hover:bg-surface-high focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
            <x-icon name="prev" class="size-7" />
        </button>

        <button type="button" data-accion="alternar" aria-label="Reproducir"
            class="flex size-14 items-center justify-center rounded-pill bg-accent text-on-accent hover:bg-accent-hover focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
            <x-icon name="play" id="np-icono-play" class="size-7" />
            <x-icon name="pause" id="np-icono-pausa" class="hidden size-7" />
        </button>

        <button type="button" data-accion="siguiente" aria-label="Siguiente"
            class="rounded-pill p-2.5 text-ink hover:bg-surface-high focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
            <x-icon name="next" class="size-7" />
        </button>

        <button type="button" id="btn-favorito" aria-label="Me gusta" aria-pressed="false"
            class="rounded-pill p-2.5 text-ink-muted hover:bg-surface-high hover:text-ink aria-pressed:text-accent focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
            <x-icon name="heart" />
        </button>
    </div>
</div>
@endsection