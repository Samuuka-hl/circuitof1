<?php 
include "../../config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['usuario_id'])) {
        $comentario = $_POST['comentario'];
        $usuario_id = $_SESSION['usuario_id'];

        // Inicializar a variável de caminho da imagem
        $imagem_caminho = null;

        // Verifica se um arquivo de imagem foi enviado
        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
            $pasta_destino = "../../uploads/";
            $imagem_nome = basename($_FILES['imagem']['name']);
            $imagem_extensao = strtolower(pathinfo($imagem_nome, PATHINFO_EXTENSION));
            $imagem_novo_nome = uniqid("img_") . '.' . $imagem_extensao; // Renomear a imagem para evitar conflitos

            // Mover a imagem para a pasta de uploads
            if (move_uploaded_file($_FILES['imagem']['tmp_name'], $pasta_destino . $imagem_novo_nome)) {
                $imagem_caminho = $pasta_destino . $imagem_novo_nome;
            } else {
                echo "Erro ao enviar a imagem.";
            }
        }

        // Inserir o comentário no banco de dados
        $sql = "INSERT INTO comentarios (usuario_id, comentario, data_postagem, imagem) VALUES (?, ?, NOW(), ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $usuario_id, $comentario, $imagem_caminho);

        if ($stmt->execute()) {
            header("Location: comunidade.php"); // Redireciona para a página da comunidade após o sucesso
            exit();
        } else {
            echo "Erro ao postar comentário: " . $stmt->error;
        }
    } else {
        echo "Você precisa estar logado para postar um comentário.";
    }
} else {
    echo "Solicitação inválida.";
}
?>
