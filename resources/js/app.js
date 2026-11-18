const pistas = window.pistas ?? [];
let i = 0;
let t = 0;
let temporizador = null;
let aleatorio = false;

const $ = (sel) => document.querySelector(sel);
const fmt = (s) => `${String(Math.floor(s / 60)).padStart(2, '0')}:${String(s % 60).padStart(2, '0')}`;

function pintar() {
    const p = pistas[i];
    if (!p) return;

    if ($('#titulo')) $('#titulo').textContent = p.titulo;
    if ($('#artista')) $('#artista').textContent = p.artista;
    if ($('#tiempo')) $('#tiempo').textContent = fmt(t);
    if ($('#duracion')) $('#duracion').textContent = fmt(p.dur);

    const pct = Math.round((t / p.dur) * 100);
    if ($('#relleno')) $('#relleno').style.width = `${pct}%`;
    if ($('#barra')) $('#barra').setAttribute('aria-valuenow', pct);

    // Sincronizar pantalla dedicada de reproducción si existe
    if ($('#np-titulo')) $('#np-titulo').textContent = p.titulo;
    if ($('#np-artista')) $('#np-artista').textContent = p.artista;
    if ($('#np-album')) $('#np-album').textContent = p.album ?? '';
    if ($('#np-tiempo')) $('#np-tiempo').textContent = fmt(t);
    if ($('#np-duracion')) $('#np-duracion').textContent = fmt(p.dur);
    if ($('#np-relleno')) $('#np-relleno').style.width = `${pct}%`;
    if ($('#np-barra')) $('#np-barra').setAttribute('aria-valuenow', pct);

    document.querySelectorAll('[data-pista]').forEach((fila) => {
        if (Number(fila.dataset.pista) === i) fila.setAttribute('aria-current', 'true');
        else fila.removeAttribute('aria-current');
    });
}

function reproduciendo() { return temporizador !== null; }

function pintarBoton() {
    const activo = reproduciendo();
    $('#icono-play')?.classList.toggle('hidden', activo);
    $('#icono-pausa')?.classList.toggle('hidden', !activo);
    $('#np-icono-play')?.classList.toggle('hidden', activo);
    $('#np-icono-pausa')?.classList.toggle('hidden', !activo);

    document.querySelectorAll('[data-accion="alternar"]').forEach((btn) => {
        btn.setAttribute('aria-label', activo ? 'Pausar' : 'Reproducir');
    });
}

function reproducir() {
    if (!pistas.length) return;
    clearInterval(temporizador);
    temporizador = setInterval(() => {
        t++;
        if (t >= pistas[i].dur) { siguiente(); return; }
        pintar();
    }, 1000);
    pintarBoton();
}

function pausar() {
    clearInterval(temporizador);
    temporizador = null;
    pintarBoton();
}

function cambiar(nueva) {
    if (!pistas.length) return;
    i = (nueva + pistas.length) % pistas.length;
    t = 0;
    pintar();
}

function siguiente() {
    if (aleatorio && pistas.length > 1) {
        let azar = i;
        while (azar === i) azar = Math.floor(Math.random() * pistas.length);
        cambiar(azar);
    } else {
        cambiar(i + 1);
    }
}

document.addEventListener('click', (e) => {
    const accion = e.target.closest('[data-accion]')?.dataset.accion;
    if (accion === 'alternar') reproduciendo() ? pausar() : reproducir();
    if (accion === 'siguiente') siguiente();
    if (accion === 'anterior') cambiar(i - 1);
    if (accion === 'reproducir-lista') { cambiar(0); reproducir(); }

    const fila = e.target.closest('[data-pista]');
    if (fila) { cambiar(Number(fila.dataset.pista)); reproducir(); }
});

['#barra', '#np-barra'].forEach((id) => {
    const el = $(id);
    if (!el) return;
    el.addEventListener('keydown', (e) => {
        const p = pistas[i];
        if (!p) return;
        if (e.key === 'ArrowRight') { t = Math.min(p.dur - 1, t + 10); pintar(); }
        if (e.key === 'ArrowLeft') { t = Math.max(0, t - 10); pintar(); }
    });
    el.addEventListener('click', (e) => {
        const p = pistas[i];
        if (!p) return;
        const rect = el.getBoundingClientRect();
        const ratio = Math.max(0, Math.min(1, (e.clientX - rect.left) / rect.width));
        t = Math.floor(ratio * p.dur);
        pintar();
    });
});
$('#btn-guardar-lista')?.addEventListener('click', (e) => {
    const btn = e.currentTarget;
    const guardado = btn.getAttribute('aria-pressed') === 'true';
    btn.setAttribute('aria-pressed', guardado ? 'false' : 'true');
    btn.textContent = guardado ? 'Guardar en biblioteca' : 'Guardada en biblioteca';
});

$('#btn-aleatorio')?.addEventListener('click', (e) => {
    aleatorio = !aleatorio;
    e.currentTarget.setAttribute('aria-pressed', aleatorio ? 'true' : 'false');
});

$('#btn-favorito')?.addEventListener('click', (e) => {
    const btn = e.currentTarget;
    const fav = btn.getAttribute('aria-pressed') === 'true';
    btn.setAttribute('aria-pressed', fav ? 'false' : 'true');
});

const raiz = document.documentElement;
try { raiz.dataset.theme = localStorage.getItem('tema') ?? 'dark'; } catch (_) {}

function alternarTema() {
    raiz.dataset.theme = raiz.dataset.theme === 'dark' ? 'light' : 'dark';
    try { localStorage.setItem('tema', raiz.dataset.theme); } catch (_) {}
}

$('#tema')?.addEventListener('click', alternarTema);
$('#tema-movil')?.addEventListener('click', alternarTema);

pintar();