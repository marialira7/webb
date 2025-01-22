// Seleciona os elementos do carrossel e botões de navegação
const carrossel = document.querySelector('.carrossel');
const prevBtn = document.getElementById('btn-prev');
const nextBtn = document.getElementById('btn-next');

// livros iniciais
adicionaLivros(0);

// Defina a quantidade de rolagem por clique (ajuste conforme necessário)
const scrollAmount = 150; // Valor que define quanto o carrossel vai rolar a cada clique

// Função para rolar o carrossel para a direita (próximo)
nextBtn.addEventListener('click', () => {
    carrossel.scrollBy({ left: scrollAmount, behavior: 'smooth' });
});

// Função para rolar o carrossel para a esquerda (anterior)
prevBtn.addEventListener('click', () => {
    carrossel.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
});

// Animação suave de rolagem ao passar o mouse sobre as imagens grandes
const imgContainers = document.querySelectorAll('.img-container img');

imgContainers.forEach(img => {
    img.addEventListener('mouseover', () => {
        img.style.transform = 'scale(1.05)';
        img.style.boxShadow = '0px 6px 15px rgba(0, 0, 0, 0.4)';
    });

    img.addEventListener('mouseout', () => {
        img.style.transform = 'scale(1)';
        img.style.boxShadow = '0px 4px 10px rgba(0, 0, 0, 0.2)';
    });
});

// Função para lidar com clique nas imagens clicáveis grandes
imgContainers.forEach(img => {
    img.addEventListener('click', () => {
        window.location.href = "#"; // Substitua com o link correto
    });
});

// // Adiciona evento de clique nas imagens menores do carrossel
// const carrosselImages = document.querySelectorAll('.carrossel-item img');

// carrosselImages.forEach(img => {
//     img.addEventListener('click', () => {
//         window.location.href = "#"; // Substitua com o link correto
//     });
// });

// Seleciona o ícone de localização e o modal
const iconeLocalizacao = document.querySelector('.item-icone svg');
const modalLocalizacao = document.getElementById('modal-localizacao');
const closeModal = document.querySelector('.close');

// Exibe o modal quando o ícone de localização é clicado
iconeLocalizacao.addEventListener('click', () => {
    modalLocalizacao.style.display = 'flex';
});

// Fecha o modal ao clicar no "x"
closeModal.addEventListener('click', () => {
    modalLocalizacao.style.display = 'none';
});

// Fecha o modal ao clicar fora do conteúdo do modal
window.addEventListener('click', (event) => {
    if (event.target === modalLocalizacao) {
        modalLocalizacao.style.display = 'none';
    }
});

// Função de busca de CEP com API
async function buscarCEP() {
    const cep = document.getElementById("cep").value;

    // Validação simples para verificar se o CEP tem 8 dígitos
    if (cep.length !== 8 || isNaN(cep)) {
        alert("Por favor, insira um CEP válido.");
        return;
    }

    try {
        const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
        const data = await response.json();

        if (data.erro) {
            alert("CEP não encontrado.");
            return;
        }

        // Formata o endereço completo
        const enderecoCompleto = `${data.logradouro} – ${data.bairro}, ${data.localidade} - ${data.uf}, Brasil`;
        
        // Atualiza o elemento com o endereço completo
        document.getElementById("endereco-completo").innerText = enderecoCompleto;
    } catch (error) {
        console.error("Erro ao buscar o CEP:", error);
        alert("Erro ao buscar o CEP. Tente novamente.");
    }
}

// Funções de salvar e exibir endereços
function adicionarEndereco() {
    const endereco = document.getElementById('endereco-completo').textContent;

    if (endereco) {
        salvarEndereco(endereco);
        exibirEnderecos();
    }
}

function salvarEndereco(endereco) {
    let enderecosSalvos = JSON.parse(localStorage.getItem('enderecos')) || [];
    
    // Verifica se o endereço já está salvo
    if (!enderecosSalvos.includes(endereco)) {
        enderecosSalvos.push(endereco);
        localStorage.setItem('enderecos', JSON.stringify(enderecosSalvos));
    }
}

function exibirEnderecos() {
    const listaEnderecos = document.getElementById('lista-enderecos');
    listaEnderecos.innerHTML = '';

    const enderecosSalvos = JSON.parse(localStorage.getItem('enderecos')) || [];
    enderecosSalvos.forEach(endereco => {
        const li = document.createElement('li');
        li.textContent = endereco;
        listaEnderecos.appendChild(li);
    });
}

// Exibe os endereços salvos ao carregar a página
window.onload = exibirEnderecos;

// Função para buscar o livro via API e redirecionar para a página de resultados
function searchBook() {
    const pesquisa = document.getElementById('searchQuery');
    if (pesquisa.value.trim() !== '') {
        window.location.href = 'resultados.php?pesq=' + pesquisa.value;
    } else {
        alert("Por favor, insira um termo de pesquisa.");
    }
    
}

const itens = document.querySelectorAll('.carrossel-item');
const livros = document.querySelector('.livros');

if (itens.length > 0 && livros) {
    itens.forEach((e, idx) => {
        e.addEventListener('click', () => (adicionaLivros(idx)));
    });
} else {
    console.error("Elementos não encontrados no DOM.");
}

async function adicionaLivros(idx) {
    const formdata = new FormData();
    formdata.append('id', idx + 1);
    const response = await fetch('php/buscarLivroPorCateg.php', {
        method: 'POST',
        body: formdata
    });

    livros.innerHTML = '';
    if (!response.ok) return;
    const req = await response.json();

    console.log(req)

    if (Array.isArray(req)) {
        req.forEach((f) => {
            let el = document.createElement('div');
    el.innerHTML = `
    <div class='item'>
        <p><strong>${f.title}</strong></p>
        <div class='image-wrapper'>
            <a href='dados.php?book_id=${f.id}'><img src='img/assim-acaba.jpg' alt=${f.title}></a> 
        </div>
        <p><strong>Autor: </strong>${f.author}</p>
    </div>`;

    livros.appendChild(el);
        });
    } else {
        const h = document.createElement('h2');
        h.textContent = 'Não existe livros nessa categoria :C';
        livros.appendChild(h)
    }
}
