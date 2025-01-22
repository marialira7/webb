<?php

class Usuario
{
    public function logar($email, $senha): bool
    {
        global $pdo; // Recebendo a varável global

        // Verificando se o usuário e senha existem no banco de dados, e bindando valores para evitar SQL Injection
        $sql = "SELECT id, senha FROM usuario WHERE email = :email";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":email", $email, PDO::PARAM_STR);
        $sql->execute();

        if ($sql->rowCount() > 0) { // Se retornar algum valor, o usuário existe
            $dado = $sql->fetch(PDO::FETCH_ASSOC); // Fetch: Cria um array recebendo os dados do usuário

            if (password_verify($senha, $dado['senha'])) {
                $_SESSION['id'] = $dado['id']; // Criando uma sessão para o ID do usuário
                return true;
            }
        }
        return false;
    }

    public function sair(): void
    {
        session_destroy(); // Destrói a sessão
        header(header: "Location: ../index.php"); // Redireciona para a página de login
    }

    public function logged($id): array
    {
        global $pdo; // Recebendo a variável global

        $array = array(); // Criando um array vazio 

        $sql = "SELECT username FROM usuario WHERE id = :id"; // Selecionando todos os dados do usuário pelo ID
        $sql = $pdo->prepare(query: $sql);
        $sql->bindValue(param: "id", value: $id);
        $sql->execute();

        if ($sql->rowCount() > 0) { // Se retornar algum valor, o usuário existe
            $array = $sql->fetch(); // Fetch: Cria um array recebendo os dados do usuário
        }

        return $array;
    }

    public function verEmail($email)
    {
        global $pdo;
        $sql = "SELECT * FROM usuario WHERE email = :email";
        $sql = $pdo->prepare($sql);
        $sql->bindValue("email", $email);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function cadastrar($username, $email, $telefone, $senha)
    {
        $senha_hashed = password_hash($senha, PASSWORD_DEFAULT);
        global $pdo;
        try {
            $sql = "INSERT INTO `usuario` (`id`, `username`, `email`, `telefone`, `senha`) VALUES (:id, :username, :email, :telefone, :senha)";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id", null, PDO::PARAM_INT);
            $sql->bindValue(":username", $username, PDO::PARAM_STR);
            $sql->bindValue(":email", $email, PDO::PARAM_STR);
            $sql->bindValue(":telefone", $telefone, PDO::PARAM_STR);
            $sql->bindValue(":senha", $senha_hashed, PDO::PARAM_STR);
            $sql->execute();
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        }
    }

    public function exibeLivros($id): array
    {
        if (!isset($_SESSION['id']) || empty($_SESSION['id']))
            return [];

        global $pdo;
        try {
            $sql = "SELECT * FROM livro WHERE user_id = :id";
            $sql = $pdo->prepare($sql);
            $sql->bindValue("id", $id);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $livro = $sql->fetchall(PDO::FETCH_ASSOC);
                return $livro;
            }

        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        }
        return [];
    }

    public function editarPerfil($nome, $email, $telefone): void
    {
        if (!isset($_SESSION['id']) || empty($_SESSION['id']))
            header(header: "Location: ../index.php");

        global $pdo;

        try {
            $query = "UPDATE usuario SET username = :nome, telefone = :telefone, email = :email WHERE id = :id";

            // Prepara a declaração
            $stmt = $pdo->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':telefone', $telefone, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);

            $stmt->execute();

        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        }
    }

    public function dadosPerfil(): array
    {
        if (!isset($_SESSION['id']) || empty($_SESSION['id']))
            header(header: "Location: ../index.php");

        global $pdo;

        try {
            $query = "SELECT * FROM usuario WHERE id = :id";

            // Prepara a declaração
            $stmt = $pdo->prepare($query);

            // Bind dos parâmetros
            $stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);

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
        return [];
    }
}
?>