<?php
require 'conexao.php'; // Conexão com o banco de dados
$gen = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

try {
    // A consulta deve usar o marcador de parâmetro sem interpolação
    $query = "SELECT categoria.genero FROM categoria join livro ON categoria.id = livro.genero WHERE categoria.id = :gen";

    // Prepara a declaração
    $stmt = $pdo->prepare($query); 

    // Bind dos parâmetros
    $stmt->bindParam(':gen', $pesq, PDO::PARAM_INT);

    // EXECUTANDO
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Define o tipo de conteúdo como JSON
        header('Content-Type: application/json; charset=utf-8');

        // Se houver resultados, retorna como JSON
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(["message" => "Nenhum resultado encontrado."], JSON_UNESCAPED_UNICODE);
    }
} catch (PDOException $e) {
    echo 'Erro: ' . $e->getMessage();
}
