<?php
require 'conexao.php'; // Conexão com o banco de dados
$pesq = filter_input(INPUT_POST, 'pesquisa', FILTER_SANITIZE_SPECIAL_CHARS);

try {
    // A consulta deve usar o marcador de parâmetro sem interpolação
    $query = "SELECT * FROM livro WHERE title LIKE :pesq";

    // Prepara a declaração
    $stmt = $pdo->prepare($query);

    // Modifica o valor do parâmetro para incluir os % no valor da pesquisa
    $pesq = '%' . $pesq . '%';

    // Bind dos parâmetros
    $stmt->bindParam(':pesq', $pesq, PDO::PARAM_STR);

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
