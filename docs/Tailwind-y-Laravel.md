# Sonora con Tailwind CSS y Laravel

Los tokens de Sonora se conectan a Tailwind como variables CSS, así el cambio entre tema oscuro y claro funciona sin duplicar clases. Usa siempre estas clases semánticas (`bg-surface-raised`, `text-ink-muted`) y nunca valores hexadecimales sueltos.

## 1. Tokens en `resources/css/app.css` (Tailwind v4, el predeterminado de Laravel actual)

```css
@import "tailwindcss";
@import url("https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400&family=Manrope:wght@400;500;700;800&display=swap");

:root, [data-theme="dark"] {
  --surface-base:#0e0e10; --surface-raised:#18181b; --surface-high:#26262b;
  --line:#3a3a42; --line-strong:#7a7a86; --ink:#f4f2ee; --ink-muted:#a9a9b4;
  --accent:#ffb020; --accent-hover:#ffc24d; --on-accent:#14110a;
  --success:#5ec8e5; --danger:#ff6b5b; --focus:#8fd3ff;
}
[data-theme="light"] {
  --surface-base:#faf8f4; --surface-raised:#ffffff; --surface-high:#ece8e0;
  --line:#d9d4c9; --line-strong:#6b665c; --ink:#17151a; --ink-muted:#55525c;
  --accent:#a65500; --accent-hover:#8a4500; --on-accent:#ffffff;
  --success:#0a6d8f; --danger:#b3261e; --focus:#0b5cad;
}

@theme inline {
  --color-surface-base:var(--surface-base); --color-surface-raised:var(--surface-raised);
  --color-surface-high:var(--surface-high); --color-line:var(--line);
  --color-line-strong:var(--line-strong); --color-ink:var(--ink); --color-ink-muted:var(--ink-muted);
  --color-accent:var(--accent); --color-accent-hover:var(--accent-hover); --color-on-accent:var(--on-accent);
  --color-success:var(--success); --color-danger:var(--danger); --color-focus:var(--focus);
  --font-sans:"Manrope", system-ui, sans-serif;
  --font-mono:"JetBrains Mono", ui-monospace, monospace;
  --radius-sm:4px; --radius-md:8px; --radius-lg:16px; --radius-pill:999px;
  --shadow-raise:0 8px 24px rgb(0 0 0 / 0.4);
}

body { @apply bg-surface-base font-sans text-ink; }
```

Con Tailwind v3 pon los mismos nombres en `theme.extend.colors` (`'surface-base': 'var(--surface-base)'`), `fontFamily`, `borderRadius` (`pill: '999px'`) y `boxShadow` (`raise`) de `tailwind.config.js`, y deja el bloque `:root` en tu CSS.

El espaciado de Sonora (4, 8, 12, 16, 24, 32 px) coincide con la escala por defecto de Tailwind: `space-1` es `p-1`, `space-4` es `p-4`, `space-8` es `p-8`. No definas otra escala.

## 2. Recetas de clases

| Pieza | Clases |
| --- | --- |
| Botón primario | `rounded-pill bg-accent px-6 py-3 text-sm font-bold text-on-accent hover:bg-accent-hover focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus` |
| Botón secundario | `rounded-pill border-2 border-line-strong px-6 py-3 text-sm font-bold text-ink hover:bg-surface-high` (más el mismo anillo de enfoque) |
| Chip (con `aria-pressed`) | `rounded-pill bg-surface-high px-4 py-2 text-xs font-bold uppercase tracking-wider text-ink aria-pressed:bg-accent aria-pressed:text-on-accent` |
| Tarjeta de medio | `rounded-md bg-surface-raised p-4 transition hover:bg-surface-high hover:shadow-raise` |
| Título de tarjeta / artista / duración | `text-xl font-bold` · `text-sm font-medium text-ink-muted` · `font-mono text-xs text-ink-muted` |
| Fila de canción | `grid grid-cols-[24px_1fr_auto] items-center gap-3 rounded-md px-2 py-3 aria-[current=true]:bg-surface-high` |
| Buscador | `w-full rounded-pill border-2 border-line-strong bg-surface-high px-4 py-3 text-sm text-ink placeholder:text-ink-muted focus-visible:outline-[3px] focus-visible:outline-focus` |
| Barra de progreso | pista `h-1 rounded-pill bg-surface-high`, relleno `h-1 rounded-pill bg-accent` con `style="width: 38%"` |
| Panel lateral / barra del reproductor | `bg-surface-raised` con `border-t border-line` (solo decorativo) |

Reglas: un solo botón primario por vista; el texto sobre ámbar es siempre `text-on-accent`; todo control lleva anillo de enfoque; los estados (éxito, error) llevan texto o icono además del color.

## 3. Reproducción simulada (sin audio real)

Basta con un arreglo de canciones y un temporizador:

```js
const pistas = [
  { titulo: "Noches de lluvia", artista: "Mar Abierto", dur: 258 },
  { titulo: "Hora azul", artista: "Luz de Norte", dur: 232 },
];
let i = 0, t = 0, timer = null;
const fmt = s => `${String(Math.floor(s / 60)).padStart(2, "0")}:${String(s % 60).padStart(2, "0")}`;

function reproducir() {
  clearInterval(timer);
  timer = setInterval(() => {
    t++;
    if (t >= pistas[i].dur) { i = (i + 1) % pistas.length; t = 0; }
    document.querySelector("#relleno").style.width = `${(t / pistas[i].dur) * 100}%`;
    document.querySelector("#tiempo").textContent = fmt(t);
  }, 1000);
}
function pausar() { clearInterval(timer); }
```

El botón de reproducir alterna los iconos `play` y `pause` de `assets/Icons` y actualiza `aria-label` ("Reproducir" / "Pausar"). Si quieren audio real más adelante, el mismo estado se conecta a un elemento `<audio>`.

## 4. Paso a Laravel

- Vite ya compila `resources/css/app.css`; incluye `@vite(['resources/css/app.css', 'resources/js/app.js'])` en el layout.
- Convierte cada pieza en un componente Blade: `resources/views/components/button.blade.php` con `@props(['variant' => 'primary'])`, y lo usas como `<x-button variant="secondary">Seguir</x-button>`. Haz lo mismo con `chip`, `media-card` y `song-row`.
- Las pistas viven en un modelo `Track` con migración y seeder (título, artista, duración en segundos, portada opcional); las pantallas Inicio, Buscar y Playlist son rutas con controlador que pasan la colección a la vista.
- El tema se guarda con `localStorage` y se aplica con `document.documentElement.dataset.theme = "light"`.
