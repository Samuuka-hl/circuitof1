<?php 
include "../config.php"; 
include "../comp/header.php"; 

// Inicia a sessão se não estiver ativa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Encerra a sessão
session_unset(); // Remove todas as variáveis de sessão
session_destroy(); // Destrói a sessão

// Mensagem de desconexão
$mensagem = "Você foi desconectado! Redirecionando...";
$tipo_mensagem = "danger"; // Tipo da mensagem para o alert

// Redireciona após 5 segundos
header("refresh:5;url=../index.php"); 
?>

<div class="container-fluid" style="margin-top: 100px; margin-bottom: 100px;">
    <div class="row justify-content-center">
        <div class="card mb-3 border-danger col-xs-10 col-sm-8 col-md-8 col-lg-4 col-xl-4 p-5" style="background-color: rgba(0, 0, 0, 0.2);" data-bs-theme="dark" data-aos="fade-up">
            <div class="row g-0 p-5">
                <div class="alert alert-<?php echo $tipo_mensagem; ?>" role="alert">
                    <?php echo $mensagem; ?>
                    <div class="spinner-border position-absolute bottom-0 end-0 me-3 mb-2" role="status">
                        <span class="visually-hidden">Carregando...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "../comp/footer.php"; ?>
