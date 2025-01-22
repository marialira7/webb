<?php
require 'conexao.php'; // Conexão com o banco de dados
header('Content-Type: text/html; charset=UTF-8');
try {
    $query = "SELECT genero FROM categoria";

    // Prepara a declaração
    $stmt = $pdo->prepare($query);

    // EXECUTANDO
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Busca todos os resultados
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Cria uma lista com os valores de "genero"
        $generos = [];
        foreach ($result as $row) {
            $generos[] = $row['genero'];
        }

        // Exibe a lista (array)
        echo json_encode($generos);
    } else {
        echo "Nenhum resultado encontrado.";
    }
} catch (PDOException $e) {
    echo 'Erro: ' . $e->getMessage();
}
