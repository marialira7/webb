<?php
require 'conexao.php'; // Conexão com o banco de dados

try {
    require 'Usuario.class.php';

    // Instanciando a classe
    $usuario = new Usuario();

    $usuario->dadosPerfil();


} catch (PDOException $e) {
    echo 'Erro: ' . $e->getMessage();
}