Sonora es un sistema de interfaz oscuro para escuchar: contenido multimedia sobre un fondo casi negro, un solo acento ámbar, controles en forma de píldora y tipografía sans con mono. Es una identidad original; no hay logo con letras, así que escribe el nombre "Sonora" con la tipografía `display` o `heading`.

## Fundamentos de contenido

- Escribe los textos de la interfaz en español, en minúsculas de oración, cortos e imperativos: "Reproducir", "Guardar en tu biblioteca", "Mezcla diaria 1".
- Háblale al oyente de "tú" ("Tu música", "Tus mezclas"); nunca de "usted", nunca signos de exclamación, nunca emojis.
- Pon primero lo principal y después los metadatos: título en `heading`, artista y álbum en `body-sm` con `ink-muted`.
- Muestra duraciones, conteos y tasas de bits en `mono` ("03:42 / 04:18").

## Fundamentos visuales

- Color: arma cada pantalla sobre `surface-base`, eleva los grupos a `surface-raised` y usa `surface-high` para chips, campos y relleno al pasar el cursor. El texto es `ink`; el secundario es `ink-muted`.
- Usa `accent` una vez por vista, en la acción principal o el elemento activo. Sobre cualquier relleno accent pon texto `on-accent`, nunca blanco ni `ink`.
- Estados: `success` (azul cielo) y `danger` (rojo anaranjado) siempre llevan una palabra o un icono, nunca solo color.
- Los divisores usan `line`; el borde de cualquier control usa `line-strong`. El foco es un anillo sólido de 3px en `focus` con 2px de separación, en todo elemento interactivo.
- Tipografía: `display`, `title` y `heading` en Manrope 700–800 con interletraje cerrado; `body` y `body-sm` en Manrope; números, tiempos y datos técnicos en JetBrains Mono (`mono`, `mono-sm`). Usa `caption` en mayúsculas solo para antetítulos.
- Forma: botones y chips son `radius-pill`; tarjetas y portadas, `radius-md`; paneles grandes, `radius-lg`. Rellena las tarjetas con `space-4` y separa las secciones con `space-8`.
- La profundidad se logra escalonando superficies; reserva `shadow-raise` para el cursor encima y los menús flotantes.
- Imágenes: las portadas y fotos llenan su marco con `radius-md`; si no hay imagen, muestra un marcador `surface-high`, nunca un degradado.
- Movimiento: 120ms con suavizado para el cursor encima y el presionado; nada se repite en bucle.

## Componentes

- Pantallas: `HomeScreen` y `NowPlaying` muestran los componentes combinados en diseños completos.
- `Button` (primario, secundario, fantasma), `Chip` (filtro y seleccionado), `MediaCard` (portada, título, artista, duración). Carga `components/bundle.css` y usa las clases `snr-` que se ven en la vista previa de cada componente.

## Iconografía

- Usa el conjunto de 24px de `assets/Icons` (reproducir, pausa, saltar, aleatorio, volumen, me gusta, buscar, inicio, biblioteca): trazos redondeados de 2px o rellenos sólidos, en `ink`, `ink-muted` o `accent`; nunca emojis. Los controles que solo llevan icono necesitan una etiqueta accesible y un contraste de 3:1 contra su fondo.
- Logo: la marca de cinco barras ecualizadoras de `assets/Logos`, ámbar sobre oscuro y `#a65500` sobre claro, siempre junto o encima del nombre escrito con tipografía.
