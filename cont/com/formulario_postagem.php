<?php 
include "../../config.php"; 
include "../../comp/header.php";

// Inicie a sessão, se ainda não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifique se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login.php");
    exit();
}
?>

<div class="container mt-5">
    <h2 class="text-light">Adicionar Comentário</h2>
    <form method="POST" action="processa_postagem.php" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="comentario" class="form-label">Comentário</label>
            <textarea class="form-control" id="comentario" name="comentario" required></textarea>
        </div>
        <div class="mb-3">
            <label for="imagem" class="form-label">Imagem (opcional)</label>
            <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*">
        </div>
        <button type="submit" class="btn btn-danger">Postar Comentário</button>
    </form>
</div>

<?php include "../../comp/footer.php"; ?>
