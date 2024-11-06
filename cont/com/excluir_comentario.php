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

// Verifica se o ID do comentário foi enviado pelo formulário e se o ID do usuário na sessão está definido
if (isset($_POST['comentario_id']) && isset($_SESSION['usuario_id'])) {
    $comentario_id = $_POST['comentario_id'];
    $usuario_id = $_SESSION['usuario_id'];

    // Debug temporário para verificar valores
    echo "<script>console.log('usuario_id na sessão: $usuario_id');</script>";
    echo "<script>console.log('comentario_id recebido: $comentario_id');</script>";

    // Consulta SQL para verificar se o comentário pertence ao usuário logado
    $sql = "SELECT id FROM comentarios WHERE id = ? AND usuario_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $comentario_id, $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Primeiro, exclui as respostas associadas ao comentário
        $sql_delete_respostas = "DELETE FROM respostas WHERE comentario_id = ?";
        $stmt_respostas = $conn->prepare($sql_delete_respostas);
        $stmt_respostas->bind_param("i", $comentario_id);
        $stmt_respostas->execute();
        $stmt_respostas->close();

        // Em seguida, exclui as curtidas associadas ao comentário
        $sql_delete_curtidas = "DELETE FROM curtidas WHERE comentario_id = ?";
        $stmt_curtidas = $conn->prepare($sql_delete_curtidas);
        $stmt_curtidas->bind_param("i", $comentario_id);
        $stmt_curtidas->execute();
        $stmt_curtidas->close();

        // Por fim, exclui o comentário
        $sql_delete_comentario = "DELETE FROM comentarios WHERE id = ?";
        $stmt_delete = $conn->prepare($sql_delete_comentario);
        $stmt_delete->bind_param("i", $comentario_id);

        if ($stmt_delete->execute()) {
            // Exclusão bem-sucedida
            echo "<script>
                    alert('Comentário excluído com sucesso!');
                    window.location.href = 'comunidade.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Erro ao excluir o comentário. Por favor, tente novamente.');
                    window.location.href = 'comunidade.php';
                  </script>";
        }

        $stmt_delete->close();
    } else {
        // Mensagem de erro se o comentário não foi encontrado ou o usuário não tem permissão
        echo "<script>
                alert('Comentário não encontrado ou você não tem permissão para excluí-lo.');
                console.log('Erro: Nenhuma correspondência encontrada para o comentário ou usuário.');
                window.location.href = 'comunidade.php';
              </script>";
    }

    $stmt->close();
} else {
    // Mensagem de erro se o ID do comentário ou o ID do usuário não estiverem definidos
    echo "<script>
            alert('Ação inválida. Por favor, tente novamente.');
            console.log('Erro: comentario_id ou usuario_id ausentes.');
            window.location.href = 'comunidade.php';
          </script>";
}

$conn->close();
?>
