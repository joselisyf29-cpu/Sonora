<!doctype html>
<html lang="es" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo', 'Sonora')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400&family=Manrope:wght@400;500;700;800&display=swap">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface-base text-ink antialiased">
    <div class="grid h-screen grid-cols-1 grid-rows-[1fr_76px_56px] md:grid-cols-[220px_1fr] md:grid-rows-[1fr_80px]">

        {{-- Navegación lateral (escritorio) --}}
        <nav class="hidden flex-col gap-2 bg-surface-raised px-4 py-6 md:flex" aria-label="Principal">
            <a href="{{ route('inicio') }}" class="mb-6 flex items-center gap-2 rounded-md text-xl font-extrabold focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
                <svg class="size-7 text-accent" viewBox="0 0 64 64" aria-hidden="true"><g fill="currentColor"><rect x="4" y="32" width="8" height="28" rx="4"/><rect x="16" y="12" width="8" height="48" rx="4"/><rect x="28" y="24" width="8" height="36" rx="4"/><rect x="40" y="4" width="8" height="56" rx="4"/><rect x="52" y="36" width="8" height="24" rx="4"/></g></svg>
                Sonora
            </a>
            <a href="{{ route('inicio') }}" @if(request()->routeIs('inicio')) aria-current="page" @endif
                class="flex items-center gap-3 rounded-md p-3 text-sm font-bold text-ink-muted hover:bg-surface-high aria-[current=page]:bg-surface-high aria-[current=page]:text-ink focus-visible:outline-[3px] focus-visible:outline-focus">
                <x-icon name="home" /> Inicio
            </a>
            <a href="{{ route('buscar') }}" @if(request()->routeIs('buscar')) aria-current="page" @endif
                class="flex items-center gap-3 rounded-md p-3 text-sm font-bold text-ink-muted hover:bg-surface-high aria-[current=page]:bg-surface-high aria-[current=page]:text-ink focus-visible:outline-[3px] focus-visible:outline-focus">
                <x-icon name="search" /> Buscar
            </a>
            <a href="{{ route('reproductor') }}" @if(request()->routeIs('reproductor')) aria-current="page" @endif
                class="flex items-center gap-3 rounded-md p-3 text-sm font-bold text-ink-muted hover:bg-surface-high aria-[current=page]:bg-surface-high aria-[current=page]:text-ink focus-visible:outline-[3px] focus-visible:outline-focus">
                <x-icon name="play" /> Reproductor
            </a>
            <x-button variant="ghost" id="tema" class="mt-auto">Cambiar tema</x-button>
        </nav>

        {{-- Contenido principal --}}
        <main class="overflow-y-auto px-4 py-6 md:px-8">
            @yield('contenido')
        </main>

        {{-- Barra del reproductor (simulado) --}}
        <div class="grid grid-cols-[1fr_auto] items-center gap-4 border-t border-line bg-surface-raised px-4 md:col-span-2 md:grid-cols-[1fr_2fr_1fr]">
            <a href="{{ route('reproductor') }}" class="min-w-0 rounded-md focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
                <p id="titulo" class="truncate text-sm font-bold"></p>
                <p id="artista" class="truncate text-xs font-medium text-ink-muted"></p>
            </a>

            <div class="flex flex-col items-center gap-1 md:gap-2">
                <div class="flex items-center gap-4 md:gap-6">
                    <button type="button" data-accion="anterior" aria-label="Anterior" class="rounded-pill p-1 focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
                        <x-icon name="prev" />
                    </button>
                    <button type="button" data-accion="alternar" aria-label="Reproducir"
                        class="flex size-10 items-center justify-center rounded-pill bg-accent text-on-accent hover:bg-accent-hover focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
                        <x-icon name="play" id="icono-play" />
                        <x-icon name="pause" id="icono-pausa" class="hidden" />
                    </button>
                    <button type="button" data-accion="siguiente" aria-label="Siguiente" class="rounded-pill p-1 focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
                        <x-icon name="next" />
                    </button>
                </div>
                <div class="hidden w-full items-center gap-2 font-mono text-xs text-ink-muted md:flex">
                    <span id="tiempo">00:00</span>
                    <div tabindex="0" class="h-1.5 flex-1 cursor-pointer rounded-pill bg-surface-high focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus"
                        role="slider" aria-label="Progreso" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" id="barra">
                        <div id="relleno" class="h-1.5 rounded-pill bg-accent" style="width: 0%"></div>
                    </div>
                    <span id="duracion">00:00</span>
                </div>
            </div>

            <div class="hidden justify-end md:flex">
                <a href="{{ route('reproductor') }}" aria-label="Abrir vista de reproducción" class="rounded-pill p-2 text-ink-muted hover:bg-surface-high hover:text-ink focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
                    <x-icon name="library" />
                </a>
            </div>
        </div>

        {{-- Navegación inferior (móvil 390px) --}}
        <nav class="flex items-center justify-around border-t border-line bg-surface-raised px-2 md:hidden" aria-label="Móvil">
            <a href="{{ route('inicio') }}" @if(request()->routeIs('inicio')) aria-current="page" @endif
                class="flex flex-col items-center gap-0.5 rounded-md px-3 py-1 text-xs font-bold text-ink-muted aria-[current=page]:text-accent focus-visible:outline-[3px] focus-visible:outline-focus">
                <x-icon name="home" class="size-5" /> Inicio
            </a>
            <a href="{{ route('buscar') }}" @if(request()->routeIs('buscar')) aria-current="page" @endif
                class="flex flex-col items-center gap-0.5 rounded-md px-3 py-1 text-xs font-bold text-ink-muted aria-[current=page]:text-accent focus-visible:outline-[3px] focus-visible:outline-focus">
                <x-icon name="search" class="size-5" /> Buscar
            </a>
            <a href="{{ route('reproductor') }}" @if(request()->routeIs('reproductor')) aria-current="page" @endif
                class="flex flex-col items-center gap-0.5 rounded-md px-3 py-1 text-xs font-bold text-ink-muted aria-[current=page]:text-accent focus-visible:outline-[3px] focus-visible:outline-focus">
                <x-icon name="play" class="size-5" /> Sonando
            </a>
            <button type="button" id="tema-movil" aria-label="Cambiar tema"
                class="flex flex-col items-center gap-0.5 rounded-md px-3 py-1 text-xs font-bold text-ink-muted focus-visible:outline-[3px] focus-visible:outline-focus">
                <x-icon name="shuffle" class="size-5" /> Tema
            </button>
        </nav>

    </div>
</body>
</html>