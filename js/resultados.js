async function pesquisa() {
    const urlParams = new URLSearchParams(window.location.search);
    const pesq = urlParams.get('pesq');
    const formdata = new FormData();
    formdata.append('pesquisa', pesq);

    const response = await fetch('php/pesquisaLivro.php', {
        method: 'POST',
        body: formdata
    });

    const livros = await response.json(); 
    exibir(livros);
    // console.log(livros);
}

function exibir(results) {
    
    const resultsContainer = document.getElementById('resultados');

    if (results && results.length > 0) {
        results.forEach(result => {
            const bookElement = document.createElement('div');

            bookElement.classList.add('book-result');
            bookElement.innerHTML = `<div class='item'>
            <p><strong>${result.title}</strong></p>
            <div class='image-wrapper'>
                <a href='dados.php?book_id=${result.id}'><img src='img/assim-acaba.jpg' alt=${result.title}></a> 
            </div>
            <p><strong>Autor: </strong>${result.author}</p>
        </div>`;
            resultsContainer.appendChild(bookElement);

        });
    } else {
        resultsContainer.innerHTML = `<p>Nenhum resultado encontrado para "${query}".</p>`;
    }
}

// Chama a função para exibir os resultados quando a página for carregada
window.onload = pesquisa;