# Sonora

 Permite navegar por playlists, buscar canciones, reproducir pistas manteniendo el estado entre vistas y cambiar entre tema oscuro y claro.

-Qué incluye el proyecto

*Inicio: Muestra las playlists disponibles, filtros por categoria ("Todo", "Musica", "Podcasts") y la cola de reproducción.

*Playlist:* Detalle de cada colección con su portada, información general y la lista de canciones con duración.

*Reproductor:* Controles básicos (play/pausa, siguiente, anterior y barra de progreso) sincronizados con `localStorage` para que la canción no se reinicie al cambiar de página.

*Buscar:* Filtro por nombre de canción, artista o playlist conectado directo a la base de datos.

*Tema claro/oscuro y vista móvil:*Cambio de tema desde la barra lateral y diseño adaptado a celular.

-Cómo correrlo en local

1.*Clonar el repositorio y entrar a la carpeta:*
   bash
   git clone <URL_DE_TU_REPOSITORIO>
   cd sonora

2.*Instalar dependencias:*
   bash
   composer install
   npm install

3.*Configurar el archivo `.env` y la base de datos:*
   bash
   cp .env.example .env
   php artisan key:generate

4.*Crear las tablas y cargar los datos de prueba:*
   bash
   php artisan migrate:fresh --seed

5.*Levantar el proyecto:*
   bash
   npm run dev
   php artisan serve
   *O si se usa laravel herd solo con poner http://sonora.test*

-Como esta organizado

*MVC con SQLite:* Las rutas en `routes/web.php` mandan todo a `MusicaController`, que consulta los modelos `Playlist` y `Track`. Los datos iniciales vienen en `SonoraSeeder` (4 playlists y 10 canciones).

*Layout compartido:* Las 4 pantallas heredan de `layouts/app.blade.php` para no repetir código de la barra lateral ni del reproductor.

*Estilos y accesibilidad:* Use variables CSS para manejar los colores de ambos temas, un boton principal  por pantalla.

-Decisiones y cambios realizados

*Componentes que reutilice:* Reutilice la plantilla `layouts/app.blade.php` para no repetir la barra lateral, el mini-reproductor ni el menú móvil en cada página, junto con los componentes Blade (`media-card`, `song-row`, `chip`, `button` e `icon`) y las variables CSS de color para manejar ambos temas.

*Que cambie:* Ajuste el diseño para que funcionara con datos dinamicos desde SQLite mediante Eloquent en lugar de dejar textos fijos en el HTML.