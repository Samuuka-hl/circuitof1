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

// Verifique se o ID do comentário e a resposta foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comentario_id']) && isset($_POST['resposta'])) {
    $comentario_id = intval($_POST['comentario_id']); // ID do comentário ao qual está respondendo
    $resposta = trim($_POST['resposta']); // Resposta enviada pelo usuário
    $usuario_id = $_SESSION['usuario_id']; // ID do usuário logado

    // Verifique se a resposta não está vazia
    if (!empty($resposta)) {
        // Prepare e execute a consulta para inserir a resposta
        $sql = "INSERT INTO respostas (comentario_id, usuario_id, resposta, data_resposta) VALUES (?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            $stmt->bind_param("iis", $comentario_id, $usuario_id, $resposta);
            if ($stmt->execute()) {
                // Resposta inserida com sucesso
                header("Location: comunidade.php?status=resposta_success");
                exit;
            } else {
                // Erro ao inserir a resposta
                header("Location: comunidade.php?status=resposta_error");
                exit;
            }
            $stmt->close();
        } else {
            // Erro ao preparar a consulta
            header("Location: comunidade.php?status=resposta_error");
            exit;
        }
    } else {
        // Resposta vazia
        header("Location: comunidade.php?status=resposta_empty");
        exit;
    }
} else {
    // Se o ID do comentário ou a resposta não forem enviados corretamente
    header("Location: comunidade.php?status=invalid_request");
    exit;
}

// Fechar a conexão
$conn->close();
?>
