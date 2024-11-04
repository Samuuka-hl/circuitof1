<?php
include "../config.php";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os valores do formulário
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    // Verifica se todos os campos foram preenchidos
    if (!empty($nome) && !empty($email) && !empty($senha)) {
        // Verifica se o e-mail ou o nome de usuário já estão cadastrados
        $sql = "SELECT id FROM usuarios WHERE email = ? OR nome = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ss", $email, $nome);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                // Nome de usuário ou e-mail já existem, redireciona com status de erro de duplicidade
                header("Location: formulario_cadastro.php?status=duplicate");
                exit();
            }

            $stmt->close();
        }

        // Hash da senha para segurança
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        // Insere os dados no banco de dados
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sss", $nome, $email, $senha_hash);

            if ($stmt->execute()) {
                // Cadastro realizado com sucesso, redireciona com status de sucesso
                header("Location: formulario_cadastro.php?status=success");
                exit();
            } else {
                // Erro ao cadastrar, redireciona com status de erro
                header("Location: formulario_cadastro.php?status=error");
                exit();
            }

            $stmt->close();
        } else {
            // Erro na preparação da consulta SQL, redireciona com status de erro
            header("Location: formulario_cadastro.php?status=error");
            exit();
        }
    } else {
        // Campos faltando, redireciona com status de campos vazios
        header("Location: formulario_cadastro.php?status=empty");
        exit();
    }
}

$conn->close();
?>
