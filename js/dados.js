import {buscarCateg} from './buscarCategorias.js';

document.addEventListener('DOMContentLoaded', async function () {
    // Carrossel: Seleciona os botões e os itens do carrossel
    const prevButton = document.querySelector('.prev');
    const nextButton = document.querySelector('.next');
    const carouselItems = document.querySelector('.carousel-items');
    const itemWidth = document.querySelector('.item').offsetWidth;
    const btn = document.querySelector('.btn_');
    const urlParams = new URLSearchParams(window.location.search);
    const id_livro = parseInt(urlParams.get('book_id'));

    const desc = document.getElementById('desc');
    const titulo = document.getElementById('titulo');
    const autor = document.getElementById('autor');
    const genero = document.getElementById('genero');
    const generos = await buscarCateg();
      

    let scrollPosition = 0;

    // Função de rolagem do carrossel
    nextButton.addEventListener('click', () => {
        if (scrollPosition < carouselItems.scrollWidth - carouselItems.clientWidth) {
            scrollPosition += itemWidth + 20; // O valor 20 é a margem entre os itens
            carouselItems.style.transform = `translateX(-${scrollPosition}px)`;
        }
    });

    prevButton.addEventListener('click', () => {
        if (scrollPosition > 0) {
            scrollPosition -= itemWidth + 20;
            carouselItems.style.transform = `translateX(-${scrollPosition}px)`;
        }
    });

    // Seleção de miniaturas
    const thumbnails = document.querySelectorAll('.thumbnails img');
    const mainImage = document.getElementById('main-image');

    // Evento de "mouseover" nas miniaturas para trocar a imagem principal
    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', function () {
            // Obtém o caminho da miniatura sobre a qual o mouse passou
            const newSrc = this.src;
            console.log('Imagem sobrevoada:', newSrc); // Verifica se o caminho da imagem está correto

            // Atualiza o src da imagem principal com o caminho da miniatura
            mainImage.src = newSrc;

            // Realça a miniatura selecionada (opcional)
            thumbnails.forEach(img => img.classList.remove('active')); // Remove a classe 'active' de todas as miniaturas
            this.classList.add('active'); // Adiciona a classe 'active' à miniatura sobre a qual o mouse passou
        });
    });

    // Faz a requisição Ajax e preenche os dados com o JSON
    mostrarDados().then(async function(data) {
        if (!data) return;
        desc.textContent = data.descricao;
        titulo.textContent = data.title;
        autor.textContent = 'Autor(a): ' + data.author;
        genero.textContent = 'Gêneros: ' + generos[data.genero - 1]

        const id = await verificaUsuario();
        if (data.user_id !== id.id) return;

        btn.textContent = 'Excluir';
        btn.className = 'btn_2';

        btn.addEventListener('click', async () => {
            if (!confirm('Deseja excluir o livro?')) return;
            const formdata = new FormData();
            formdata.append('id', id_livro);

            const response = await fetch('php/excluirLivro.php', {
                method: 'POST',
                body: formdata
            }); 

            if (!response.ok) console.log('Erro ao apagar o livro.');

            window.location.href = 'perfil.php';
        });
    });

    // Funções
    async function mostrarDados() {
        try {
            const formdata = new FormData();
            
            formdata.append('id', id_livro);

            const response = await fetch('php/dadosLivro.php', {
                method: 'POST',
                body: formdata
            });
        
            if (response.ok) {
                const data = await response.json(); 
                return data;
            }
        
        } catch (error) {
            console.error('Erro ao buscar os dados do livro: ', error);
        }
    }

    async function verificaUsuario() {
        const verifica = await fetch('php/dadosUsuario.php');
        if (!verifica.ok) return;

        const txt = await verifica.json();
        return txt;
    }
    
});
