<?php 
include "../../config.php"; 
include "../../comp/header.php";

// Inicia a sessão se não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<div class="mb-5">
    <div class="container mt-5 mb-5" data-bs-theme="dark">
    <h1 class="text-center text-danger" style="margin-top: 100px; margin-bottom: 100px;">Comunidade</h1>

        <div class="mb-3">
            <!-- Botão para adicionar um comentário -->
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                <a href="formulario_postagem.php" class="btn btn-danger position-fixed bottom-0 end-0 me-5" style="margin-bottom: 13vh;">
                    <i class="fa-solid fa-plus"></i>
                </a>
            <?php else: ?>
                <button type="button" class="btn btn-secondary position-fixed bottom-0 end-0 me-5" style="margin-bottom: 13vh;" disabled>
                    <i class="fa-solid fa-plus"></i> Faça login para comentar
                </button>
            <?php endif; ?>
        </div>    

        <div class="row">
            <?php
            // Consulta para pegar os comentários do banco de dados, incluindo o ID do usuário que fez o comentário
            $sql = "SELECT comentarios.id, comentarios.comentario, comentarios.data_postagem, comentarios.usuario_id, usuarios.nome, comentarios.imagem AS comentario_imagem 
                    FROM comentarios 
                    JOIN usuarios ON comentarios.usuario_id = usuarios.id 
                    ORDER BY comentarios.data_postagem DESC";
            
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $comentario_id = htmlspecialchars($row['id']);
                    $usuario_id = htmlspecialchars($row['usuario_id']);
                    
                    echo '<div class="card mb-3 border-danger mx-auto w-75" style="background-color: rgba(0, 0, 0, 0.2);" data-aos="fade-up">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title ms-5 mb-3">' . htmlspecialchars($row['nome']) . '</h5>';
                    
                    // Exibe a imagem do comentário se existir
                    if (!empty($row['comentario_imagem'])) {
                        echo '<img src="' . htmlspecialchars($row['comentario_imagem']) . '" alt="Imagem do comentário" class="img-fluid rounded-3 mb-3 mx-auto d-block" style="max-width: 90%; height: auto;"><br>';
                    }

                    echo '<p class="card-text text-center">' . htmlspecialchars($row['comentario']) . '</p>';

                    // Exibe a contagem de curtidas
                    $curtidas_sql = "SELECT COUNT(*) as total_curtidas FROM curtidas WHERE comentario_id = ?";
                    $stmt = $conn->prepare($curtidas_sql);
                    $stmt->bind_param("i", $comentario_id);
                    $stmt->execute();
                    $result_curtidas = $stmt->get_result();
                    $curtidas = $result_curtidas->fetch_assoc();
                    $total_curtidas = $curtidas['total_curtidas'];

                    // Exibe os botões de curtir/descurtir
                    $curtida_usuario_sql = "SELECT * FROM curtidas WHERE comentario_id = ? AND usuario_id = ?";
                    $stmt_curtida_usuario = $conn->prepare($curtida_usuario_sql);
                    $stmt_curtida_usuario->bind_param("ii", $comentario_id, $_SESSION['usuario_id']);
                    $stmt_curtida_usuario->execute();
                    $resultado_curtida_usuario = $stmt_curtida_usuario->get_result();

                    echo '<div class="row justify-content-start mb-4">';

                    // Botões de curtir/descurtir
                    if ($resultado_curtida_usuario->num_rows > 0) {
                        echo '<button type="button" class="btn btn-danger btn-sm ms-5 col-1" onclick="descurtirComentario(' . $comentario_id . ')"><i class="fa-solid fa-thumbs-up"></i>';
                    } else {
                        echo '<button type="button" class="btn btn-danger btn-sm ms-5 col-1" onclick="curtirComentario(' . $comentario_id . ')"><i class="fa-regular fa-thumbs-up"></i>';
                    }

                    echo '<span class="text-light">' . $total_curtidas . '</span></button>';

                    // Botão para mostrar o formulário de resposta
                    echo '<button type="button" class="btn btn-danger btn-sm ms-2 col-1" onclick="toggleResposta(' . htmlspecialchars($row['id']) . ')"><i class="fa-regular fa-comment"></i></button>';

                    // Exibe o botão de exclusão se o usuário é o autor do comentário
                    if (isset($_SESSION['usuario_id']) && $_SESSION['usuario_id'] == $usuario_id) {
                        echo '<button type="button" class="btn btn-sm btn-secondary col-1 position-absolute end-0 me-5" data-bs-toggle="modal" data-bs-target="#modalExcluirComentario" onclick="setComentarioId(' . $comentario_id . ')"><i class="fa-solid fa-trash"></i></button>';
                    }
                    

                    // Formulário para responder ao comentário
                    echo '<div id="formResposta' . htmlspecialchars($row['id']) . '" class="mt-3" style="display:none;">';
                    echo '<form method="POST" action="processa_resposta.php">';
                    echo '<input type="hidden" name="comentario_id" value="' . htmlspecialchars($row['id']) . '">';
                    echo '<div class="mb-3">';
                    echo '<textarea class="form-control" name="resposta" placeholder="Digite sua resposta..." required></textarea>';
                    echo '</div>';
                    echo '<button type="submit" class="btn btn-danger btn-sm me-2 mb-3">Responder</button>';
                    echo '</form>';
                    echo '</div>'; // fecha div do formulário de resposta

                    // Consulta para pegar as respostas desse comentário
                    $respostas_sql = "SELECT respostas.id, respostas.resposta, respostas.data_resposta, usuarios.nome 
                                    FROM respostas 
                                    JOIN usuarios ON respostas.usuario_id = usuarios.id 
                                    WHERE respostas.comentario_id = ? 
                                    ORDER BY respostas.data_resposta ASC";
                    $respostas_stmt = $conn->prepare($respostas_sql);
                    $respostas_stmt->bind_param("i", $row['id']);
                    $respostas_stmt->execute();
                    $respostas_result = $respostas_stmt->get_result();

                    if ($respostas_result->num_rows > 0) {
                        // Adiciona o Collapse
                        echo '<div class="col-1">';
                        echo '<button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#respostasCollapse' . $row['id'] . '" aria-expanded="false" aria-controls="respostasCollapse' . $row['id'] . '"><i class="fa-solid fa-comments"></i></button>';
                        echo '</div>';
                        echo '<div class="collapse mt-4" id="respostasCollapse' . $row['id'] . '">';
                        
                        while ($resposta_row = $respostas_result->fetch_assoc()) {
                            echo '<div class="card mb-2 border-dark" style="background-color: rgba(0, 0, 0, 0.1);">';
                            echo '<div class="card-body">';
                            echo '<h6 class="card-title">' . htmlspecialchars($resposta_row['nome']) . '</h6>';
                            echo '<p class="card-text">' . htmlspecialchars($resposta_row['resposta']) . '</p>';
                            echo '<p class="card-text"><small class="text-muted">' . htmlspecialchars($resposta_row['data_resposta']) . '</small></p>';
                            echo '</div>';
                            echo '</div>';
                        }
                        
                        echo '</div>'; // fecha collapse
                        echo '</div>';
                    } else {
                        echo '<p class="text-muted">Nenhuma resposta ainda.</p>';
                    }

                    echo '<p class="card-text"><small class="text-muted">' . htmlspecialchars($row['data_postagem']) . '</small></p>';
                    echo '</div>'; // fecha card-body
                    echo '</div>'; // fecha card
                }
            } else {
                echo '<p class="text-light">Nenhum comentário encontrado.</p>';
            }
            ?>
        </div>
    </div>
</div>

<!-- Modal de Exclusão de Comentário -->
<div class="modal fade" id="modalExcluirComentario" tabindex="-1" aria-labelledby="modalExcluirComentarioLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalExcluirComentarioLabel">Excluir Comentário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Você tem certeza que deseja excluir este comentário?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="formExcluirComentario" method="POST" action="excluir_comentario.php">
                    <input type="hidden" name="comentario_id" id="comentarioId">
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleResposta(comentarioId) {
        var form = document.getElementById('formResposta' + comentarioId);
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }

    function setComentarioId(id) {
        document.getElementById('comentarioId').value = id;
    }

    function curtirComentario(comentarioId) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "curtir.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function() {
            if (xhr.status === 200) {
                location.reload();
            }
        };
        xhr.send("comentario_id=" + comentarioId);
    }

    function descurtirComentario(comentarioId) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "descurtir.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function() {
            if (xhr.status === 200) {
                location.reload();
            }
        };
        xhr.send("comentario_id=" + comentarioId);
    }
</script>

<?php include "../../comp/footer.php"; ?>
