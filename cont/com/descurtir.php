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

    // Prepare e execute a consulta para remover a curtida
    $sql = "DELETE FROM curtidas WHERE comentario_id = ? AND usuario_id = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("ii", $comentario_id, $usuario_id);
        if ($stmt->execute()) {
            // Curtida removida com sucesso
            header("Location: comunidade.php?status=descurtida_success");
            exit;
        } else {
            // Erro ao remover a curtida
            header("Location: comunidade.php?status=descurtida_error");
            exit;
        }
        $stmt->close();
    } else {
        // Erro ao preparar a consulta
        header("Location: comunidade.php?status=descurtida_error");
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
