<?php
include "../../config.php";

// Inicia a sessão se ainda não foi iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../../login.php");
    exit();
}

// Verifica se o ID do comentário foi enviado pelo formulário e o ID do usuário na sessão está definido
if (isset($_POST['comentario_id']) && isset($_SESSION['usuario_id'])) {
    $comentario_id = $_POST['comentario_id'];
    $usuario_id = $_SESSION['usuario_id'];

    // Consulta SQL para verificar se o comentário pertence ao usuário logado
    $sql = "SELECT id FROM comentarios WHERE id = ? AND usuario_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $comentario_id, $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // O comentário pertence ao usuário logado; pode ser excluído
        $sql_delete = "DELETE FROM comentarios WHERE id = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("i", $comentario_id);

        if ($stmt_delete->execute()) {
            // Exclusão bem-sucedida
            echo "<script>
                    alert('Comentário excluído com sucesso!');
                    window.location.href = 'comunidade.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Erro ao excluir o comentário.');
                    window.location.href = 'comunidade.php';
                  </script>";
        }

        $stmt_delete->close();
    } else {
        echo "<script>
                alert('Comentário não encontrado ou você não tem permissão para excluí-lo.');
                window.location.href = 'comunidade.php';
              </script>";
    }

    $stmt->close();
} else {
    echo "<script>
            alert('Ação inválida.');
            window.location.href = 'comunidade.php';
          </script>";
}

$conn->close();
?>
