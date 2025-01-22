<?php
require 'conexao.php'; // Conexão com o banco de dados

try {
    $name = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $telefone = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_SPECIAL_CHARS);

    require 'Usuario.class.php';

    // Instanciando a classe
    $usuario = new Usuario();

    $usuario->editarPerfil($name, $email, $telefone);


} catch (PDOException $e) {
    echo 'Erro: ' . $e->getMessage();
}