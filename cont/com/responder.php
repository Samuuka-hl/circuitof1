<?php
include "../../config.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['usuario_id'])) {
    $comentario_id = $_POST['comentario_id'];
    $usuario_id = $_SESSION['usuario_id'];
    $resposta = $_POST['resposta'];

    $sql = "INSERT INTO respostas (comentario_id, usuario_id, resposta) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $comentario_id, $usuario_id, $resposta);

    if ($stmt->execute()) {
        header("Location: comunidade.php");
    } else {
        echo "Erro ao postar resposta.";
    }
} else {
    echo "Você precisa estar logado para responder.";
}
?>
