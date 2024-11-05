<?php
// Inicie a sessão
session_start();

// Inclua o arquivo de configuração do banco de dados
include "../../config.php";

// Verifique se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php"); // Redireciona para a página de login se não estiver logado
    exit;
}

// Verifique se o ID do comentário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comentario_id'])) {
    $comentario_id = intval($_POST['comentario_id']); // Certifique-se de que o ID do comentário é um número inteiro
    $usuario_id = $_SESSION['usuario_id']; // Pegue o ID do usuário logado

    // Prepare e execute a consulta para inserir a curtida
    $sql = "INSERT INTO curtidas (comentario_id, usuario_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("ii", $comentario_id, $usuario_id);
        if ($stmt->execute()) {
            // Curtida registrada com sucesso
            header("Location: comunidade.php?status=curtida_success");
            exit;
        } else {
            // Erro ao inserir a curtida
            header("Location: comunidade.php?status=curtida_error");
            exit;
        }
        $stmt->close();
    } else {
        // Erro ao preparar a consulta
        header("Location: comunidade.php?status=curtida_error");
        exit;
    }
} else {
    // Se o ID do comentário não for enviado corretamente
    header("Location: comunidade.php?status=invalid_request");
    exit;
}

// Fechar a conexão
$conn->close();
?>
