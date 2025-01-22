<?php
require 'conexao.php'; // Conexão com o banco de dados
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

try {
    $query = "SELECT * FROM livro WHERE id = :id";

    // Prepara a declaração
    $stmt = $pdo->prepare($query);

    // Bind dos parâmetros
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // EXECUTANDO
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Define o tipo de conteúdo como JSON
        header('Content-Type: application/json; charset=utf-8');

        // Se houver resultados, retorna como JSON
        if ($result) {
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(["message" => "Nenhum resultado encontrado."], JSON_UNESCAPED_UNICODE);
        }
    }
} catch (PDOException $e) {
    echo 'Erro: ' . $e->getMessage();
}