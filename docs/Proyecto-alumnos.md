# Proyecto Sonora: brief para estudiantes

Construyan una aplicación web de música llamada Sonora siguiendo este sistema de diseño. La reproducción puede ser simulada: lo que se evalúa es la fidelidad al sistema, la calidad del código y la accesibilidad.

## Alcance

- **Obligatorio (fase 1, HTML + Tailwind CSS):** pantallas Inicio, Playlist y Reproductor, con navegación entre ellas.
- **Opcional (fase 2, Laravel):** pasar las pantallas a Blade, con canciones desde la base de datos y rutas reales.
- **Extra:** Buscar, tema claro, versión móvil de 390px.
- Datos de ejemplo propios: al menos 8 canciones y 4 playlists, inventadas. No usen música, nombres ni portadas de artistas reales.

## Qué deben respetar

1. Usar solo tokens del sistema (colores, tipografía, radios, espaciado); ningún hexadecimal suelto.
2. Tipografía Manrope para texto y JetBrains Mono para tiempos y números.
3. Un solo botón primario ámbar por vista, con texto `on-accent`.
4. Anillo de enfoque visible en todo control, uso completo con teclado y etiquetas accesibles en botones de solo icono.
5. Textos en español, en minúsculas de oración, sin emojis.
6. Usar los iconos y la marca de `assets/`; no copiar logos ni diseños de servicios reales.

## Entregables

- Repositorio con el código y un `README` que diga cómo ejecutarlo.
- Capturas de cada pantalla en tema oscuro (y claro, si lo hicieron).
- Una lista corta de decisiones: qué componentes reutilizaron y qué cambiarían.

## Rúbrica sugerida (100 puntos)

| Criterio | Puntos |
| --- | --- |
| Fidelidad al sistema de diseño (tokens, tipografía, componentes) | 30 |
| Maquetación y responsividad | 20 |
| Accesibilidad (contraste, foco, teclado, etiquetas) | 20 |
| Estructura y limpieza del código (componentes, nombres) | 20 |
| Reproducción simulada funcionando | 10 |
