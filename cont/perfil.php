<?php include "../config.php"; ?>
<?php include "../comp/header.php"; ?>

<?php
// Verifica se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}
?>

<div class="container-fluid" style="margin-top: 100px; margin-bottom: 100px;">
    <div class="row justify-content-center">
        <div class="card mb-3 border-danger col-xs-10 col-sm-8 col-md-8 col-lg-4 col-xl-4 p-5" style="background-color: rgba(0, 0, 0, 0.2);" data-bs-theme="dark" data-aos="fade-up">
            <div class="row g-0 p-5">
                <h2 class="text-center mb-4">Informações do Usuário</h2>
                <p><strong>Nome:</strong> <?php echo htmlspecialchars($_SESSION['nome']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
                <!-- Adicione mais informações conforme necessário -->
                <a class="btn btn-danger mt-4" href="logout.php">Sair</a>
            </div>
        </div>
    </div>
</div>

<?php include "../comp/footer.php"; ?>
