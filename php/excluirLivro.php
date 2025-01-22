<?php
require 'conexao.php'; // Conexão com o banco de dados
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

try {
    $query = "DELETE FROM livro WHERE id = :id";

    // Prepara a declaração
    $stmt = $pdo->prepare($query);

    // Bind dos parâmetros
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // EXECUTANDO
    $stmt->execute();
} catch (PDOException $e) {
    echo 'Erro: ' . $e->getMessage();
}