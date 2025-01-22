<?php
require 'conexao.php'; // Conexão com o banco de dados

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_SESSION['id'];
    $titulo = $_POST['name_livro'];
    $autor = $_POST['name_autor'];
    $editora = $_POST['name_editora'];
    $genero = $_POST['genero'];
    $descricao = $_POST['descricao'];

    /* ============= COLOCAR AQUI O PROCESSO PRA SALVAR O ARQUIVO NO SERVIDOR
    // Processar upload da capa do livros publicados
    $capa = null;
    if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
        $upload_dir = 'uploads/';
        $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $capa = $upload_dir . uniqid() . '.' . $ext;
        move_uploaded_file($_FILES['file']['tmp_name'], $capa);
    }
    */

    $capa = uniqid(); // COLOCAR AQUI O CAMINHO GERADO PELO PROCESSO ACIMA

    // Inserir os dados no banco
    $stmt = $pdo->prepare("INSERT INTO livro (titulo, autor,  genero, descricao, capa, user_id) 
                           VALUES (:titulo, :autor, :genero, :descricao, :capa, :userid)");
    $stmt->execute([
        ':userid' => $usuario_id,
        ':titulo' => $titulo,
        ':autor' => $autor,
        ':genero' => $genero,
        ':descricao' => $descricao,
        ':capa' => $capa,
    ]);

    header("Location: ../perfil.php");
    exit;
}
?>