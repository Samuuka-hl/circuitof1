<?php
include "../../config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comentario_id'])) {
    session_start();
    
    if (isset($_SESSION['usuario_id'])) {
        $usuario_id = $_SESSION['usuario_id'];
        $comentario_id = $_POST['comentario_id'];

        // Verifica se o usuário já curtiu o comentário
        $sql = "SELECT id FROM curtidas WHERE comentario_id = ? AND usuario_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $comentario_id, $usuario_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 0) {
            // Insere a curtida se ela ainda não existir
            $sql_insert = "INSERT INTO curtidas (comentario_id, usuario_id) VALUES (?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bind_param("ii", $comentario_id, $usuario_id);
            $stmt_insert->execute();
            echo json_encode(["status" => "success", "message" => "Curtida adicionada"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Já curtiu este comentário"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Necessário login"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Requisição inválida"]);
}
?>
