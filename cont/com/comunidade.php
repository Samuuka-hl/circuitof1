<?php 
include "../../config.php"; 
include "../../comp/header.php";

// Inicie a sessão, se ainda não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="container mt-5">
    <h2 class="text-light">Comunidade F1</h2>

    <div class="mb-3">
        <!-- Botão para adicionar um comentário -->
        <?php if (isset($_SESSION['usuario_id'])): ?>
            <a href="formulario_postagem.php" class="btn btn-danger position-absolute bottom-0 end-0 me-5" style="margin-bottom: 13vh;">
                <i class="fa-solid fa-plus"></i> Adicionar Comentário
            </a>
        <?php else: ?>
            <button type="button" class="btn btn-secondary position-absolute bottom-0 end-0 me-5" style="margin-bottom: 13vh;" disabled>
                <i class="fa-solid fa-plus"></i> Faça login para comentar
            </button>
        <?php endif; ?>
    </div>    

    <div class="row">
        <?php
        // Consulta para pegar os comentários do banco de dados
        $sql = "SELECT comentarios.id, comentarios.comentario, comentarios.data_postagem, usuarios.nome, usuarios.imagem AS usuario_imagem, usuarios.id AS usuario_id, comentarios.imagem AS comentario_imagem 
                FROM comentarios 
                JOIN usuarios ON comentarios.usuario_id = usuarios.id 
                ORDER BY comentarios.data_postagem DESC";
        
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Loop através dos resultados e exibir os comentários
            while ($row = $result->fetch_assoc()) {
                echo '<div class="card mb-3">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . htmlspecialchars($row['nome']) . '</h5>';
                echo '<p class="card-text">' . htmlspecialchars($row['comentario']) . '</p>';
                echo '<p class="card-text"><small class="text-muted">' . htmlspecialchars($row['data_postagem']) . '</small></p>';
                
                // Exibe a imagem do usuário se existir
                if (!empty($row['usuario_imagem'])) {
                    echo '<img src="' . htmlspecialchars($row['usuario_imagem']) . '" alt="Imagem do usuário" class="img-fluid" style="max-width: 100px; height: auto;">';
                }

                // Exibe a imagem do comentário se existir
                if (!empty($row['comentario_imagem'])) {
                    echo '<img src="' . htmlspecialchars($row['comentario_imagem']) . '" alt="Imagem do comentário" class="img-fluid" style="max-width: 300px; height: auto;">';
                }

                // Exibe o botão de exclusão se o usuário é o autor do comentário
                if (isset($_SESSION['usuario_id']) && $_SESSION['usuario_id'] == $row['usuario_id']) {
                    echo '<form method="POST" action="excluir_comentario.php" style="display:inline;">';
                    echo '<input type="hidden" name="comentario_id" value="' . htmlspecialchars($row['id']) . '">';
                    echo '<button type="submit" class="btn btn-danger btn-sm">Excluir</button>';
                    echo '</form>';
                }
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p class="text-light">Nenhum comentário encontrado.</p>';
        }
        ?>
        
    </div>
</div>

<?php include "../../comp/footer.php"; ?>
