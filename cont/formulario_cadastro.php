<?php include "../config.php"; ?>
<?php include "../comp/header.php"; ?>

<div class="container-fluid" style="margin-top: 100px; margin-bottom: 100px;">
    <div class="row justify-content-center">
        <div class="card mb-3 border-danger col-xs-10 col-sm-8 col-md-8 col-lg-4 col-xl-4 p-5" style="background-color: rgba(0, 0, 0, 0.2);" data-bs-theme="dark" data-aos="fade-up">
            <div class="row g-0 p-5">
                <form data-bs-theme="dark" action="processa_cadastro.php" method="POST">
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Nome de Usuário</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="exemplo@email.com" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senha" placeholder="********" name="senha" required>
                    </div>
                    <button type="submit" class="btn btn-danger mt-4">Enviar!</button>
                </form>
            </div>

            <?php if (isset($_GET['status'])): ?>
                <?php if ($_GET['status'] == 'success'): ?>
                    <div class="alert alert-primary" role="alert" id="success">
                        Cadastrado com sucesso! - Redirecionando
                        <div class="spinner-border position-absolute bottom-0 end-0 me-3 mb-2" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <script>
                        // Redireciona para a página inicial após 5 segundos
                        setTimeout(function() {
                            window.location.href = "../index.php";
                        }, 5000);
                    </script>
                <?php elseif ($_GET['status'] == 'error'): ?>
                    <div class="alert alert-danger" role="alert" id="error">
                        Erro ao cadastrar! Tente novamente.
                    </div>
                <?php elseif ($_GET['status'] == 'empty'): ?>
                    <div class="alert alert-danger" role="alert" id="error">
                        Por favor, preencha todos os campos.
                    </div>
                <?php elseif ($_GET['status'] == 'duplicate'): ?>
                    <div class="alert alert-danger" role="alert" id="error">
                        O nome de usuário ou o e-mail informado já estão cadastrados!
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include "../comp/footer.php"; ?>
