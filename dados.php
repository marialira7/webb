<?php require "php/verifica.php"; ?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dados.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/footer.css">
    <script type="module" src="js/dados.js" defer></script> <!-- JavaScript externo -->
    <script type="module" src="js/buscarCategorias.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Dados do Livros</title>
</head>

<body>
    <?php require_once('navbar.php'); ?>
    <div class="main-container">
        <div class="main-box">
            <div class="esquerda">
                <div class="product-image">
                    <img id="main-image" src="img/assim-acaba.jpg" alt="livro principal">
                </div>

                <div class="thumbnails">
                    <img src="img/frente-assim-que-acaba.jpg" alt="Frente"
                        onclick="trocarImagem('img/frente-assim-que-acaba.jpeg')" />
                    <img src="img/pessoa_segurando_livro.png" alt="Capa"
                        onclick="trocarImagem('img/capa_assim_que_acaba.jpeg')" />
                    <img src="img/assim-acaba.jpg" alt="Livro" onclick="trocarImagem('img/assim-acaba.png')" />
                </div>
            </div>

            <div class="direita">
                <div class="sinopse">
                    <h2>Sinopse</h2>
                    <p id="desc">O romance mais pessoal da carreira de Colleen Hoover, É assim que acaba discute temas
                        como
                        violência doméstica e abuso psicológico de forma sensível e direta.
                        Em É assim que acaba, Colleen Hoover nos apresenta Lily, uma jovem que se mudou de uma
                        cidadezinha do Maine para Boston, se formou em marketing e abriu a própria floricultura.
                        E é em um dos terraços de Boston que ela conhece Ryle, um neurocirurgião confiante, teimoso e
                        talvez até um pouco arrogante, com uma grande aversão a relacionamentos, mas que se sente muito
                        atraído por ela.
                    </p>
                </div>

                <div class="dados">
                    <h2 id="titulo">É Assim que Acaba</h2>
                    <p id="autor">Autor(a): Collen Hoover</p>
                    <p id="editora">Editora: Grupo Editorial Record</p>
                    <p id="pags">Páginas: 368</p>
                    <p id="data_publi">Data da primeira publicação: 2 de agosto de 2016</p>
                    <p id="seguido">Seguido por: É Assim Que Começa</p>
                    <p id="genero">Gêneros: Romance de amor, Ficção, Romance contemporâneo</p>

                </div>

                <div class="button">
                    <button class="btn_">Salvar</button>
                </div>

            </div>
        </div>
    </div>

    <div class="carousel-container">
        <h2>Você também pode gostar disso</h2>
        <div class="carousel">
            <button class="prev"></button>
            <div class="carousel-items">
                <!-- Modificando aqui para garantir que todas as imagens tenham a mesma estrutura e tamanho -->
                <div class="item">
                    <div class="image-wrapper">
                        <img src="img/assim-acaba.jpg" alt="livro 1">
                    </div>
                    <p>livro - é assim que começa</p>
                    <div class="botao">
                        <button class="ver-mais">Ver mais</button>
                    </div>
                </div>
                <div class="item">
                    <div class="image-wrapper">
                        <img src="img/assim-acaba.jpg" alt="livro 1">
                    </div>
                    <p>livro - é assim que começa</p>
                    <div class="botao">
                        <button class="ver-mais">Ver mais</button>
                    </div>
                </div>
                <div class="item">
                    <div class="image-wrapper">
                        <img src="img/assim-acaba.jpg" alt="livro 1">
                    </div>
                    <p>livro - é assim que começa</p>
                    <div class="botao">
                        <button class="ver-mais">Ver mais</button>
                    </div>
                </div>
                <div class="item">
                    <div class="image-wrapper">
                        <img src="img/assim-acaba.jpg" alt="livro 1">
                    </div>
                    <p>livro - é assim que começa</p>
                    <div class="botao">
                        <button class="ver-mais">Ver mais</button>
                    </div>
                </div>
                <div class="item">
                    <div class="image-wrapper">
                        <img src="img/assim-acaba.jpg" alt="livro 1">
                    </div>
                    <p>livro - é assim que começa</p>
                    <div class="botao">
                        <button class="ver-mais">Ver mais</button>
                    </div>
                </div>
                <div class="item">
                    <div class="image-wrapper">
                        <img src="img/assim-acaba.jpg" alt="livro 1">
                    </div>
                    <p>livro - é assim que começa</p>
                    <div class="botao">
                        <button class="ver-mais">Ver mais</button>
                    </div>
                </div>
                <div class="item">
                    <div class="image-wrapper">
                        <img src="img/assim-acaba.jpg" alt="livro 1">
                    </div>
                    <p>livro - é assim que começa</p>
                    <div class="botao">
                        <button class="ver-mais">Ver mais</button>
                    </div>
                </div>
                <div class="item">
                    <div class="image-wrapper">
                        <img src="img/assim-acaba.jpg" alt="livro 1">
                    </div>
                    <p>livro - é assim que começa</p>
                    <div class="botao">
                        <button class="ver-mais">Ver mais</button>
                    </div>
                </div>
            </div>
            <button class="next">❯</button>
        </div>
    </div>

    <div class="botao-flutuante-whatsapp">
        <a href="https://wa.me/XXXXXXXXXXX" target="_blank">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>
    <?php require_once('footer.php'); ?>


</body>

</html>