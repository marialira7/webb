import {buscarCateg} from './buscarCategorias.js';

document.addEventListener('DOMContentLoaded', async function () {
    const lista = document.getElementById('seletor');
    const generos = await buscarCateg();

    generos.forEach((e, idx) => {
        const el = document.createElement('option');
        el.setAttribute('value', idx + 1);
        el.textContent = e;

        lista.appendChild(el);
    });
});