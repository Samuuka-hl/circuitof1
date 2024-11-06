<?php 
include "../../config.php"; 
include "../../comp/header.php";

// Inicia a sessão se não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php"); // Redireciona para a página de login se não estiver logado
    exit;
}
?>

<div class="container-fluid" style="margin-top: 100px; margin-bottom: 100px;">
    <div class="row justify-content-center">
        <div class="card mb-3 border-danger col-xs-10 col-sm-8 col-md-8 col-lg-4 col-xl-4 p-5" style="background-color: rgba(0, 0, 0, 0.2);" data-bs-theme="dark" data-aos="fade-up">
            <div class="row g-0 p-5">
                <h2 class="text-center text-light">Adicionar Comentário</h2>
                <form data-bs-theme="dark" action="processa_postagem.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="comentario" class="form-label text-light">Comentário</label>
                        <textarea class="form-control" id="comentario" name="comentario" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="imagem" class="form-label text-light">Imagem (opcional)</label>
                        <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*" onchange="previewImage(event)">
                    </div>
                    <!-- Prévia da Imagem -->
                    <div id="previewContainer" class="mb-3" style="display:none;">
                        <h5 class="text-light">Prévia da Imagem:</h5>
                        <img id="preview" src="#" alt="Prévia da imagem" class="img-fluid" style="max-width: 100%; height: auto;">
                    </div>
                    <button type="submit" class="btn btn-danger mt-4">Enviar!</button>
                </form>
            </div>

            <?php if (isset($_GET['status'])): ?>
                <?php if ($_GET['status'] == 'success'): ?>
                    <div class="alert alert-primary" role="alert" id="success">
                        Comentário adicionado com sucesso! - Redirecionando
                        <div class="spinner-border position-absolute bottom-0 end-0 me-3 mb-2" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <script>
                        // Redireciona para a página da comunidade após 5 segundos
                        setTimeout(function() {
                            window.location.href = "comunidade.php";
                        }, 5000);
                    </script>
                <?php elseif ($_GET['status'] == 'error'): ?>
                    <div class="alert alert-danger" role="alert" id="error">
                        Erro ao adicionar comentário! Tente novamente.
                    </div>
                <?php elseif ($_GET['status'] == 'empty'): ?>
                    <div class="alert alert-danger" role="alert" id="error">
                        Por favor, preencha todos os campos.
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    // Função para mostrar a prévia da imagem
    function previewImage(event) {
        const previewContainer = document.getElementById('previewContainer');
        const previewImage = document.getElementById('preview');
        
        // Verifica se um arquivo foi selecionado
        if (event.target.files && event.target.files[0]) {
            const reader = new FileReader();
            
            // Quando a leitura do arquivo estiver completa, atualiza a prévia
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.style.display = 'block'; // Mostra o contêiner da prévia
            }
            
            reader.readAsDataURL(event.target.files[0]); // Lê o arquivo como URL
        } else {
            previewContainer.style.display = 'none'; // Oculta o contêiner se nenhum arquivo for selecionado
        }
    }
</script>

<?php include "../../comp/footer.php"; ?>
