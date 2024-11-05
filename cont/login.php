    <?php
    include "../config.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = trim($_POST['email']);
        $senha = trim($_POST['senha']);

        $sql = "SELECT id, nome, senha FROM usuarios WHERE email = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            // Verifica se o usuário existe
            if ($stmt->num_rows == 1) {
                $stmt->bind_result($id, $nome, $senha_hash);
                $stmt->fetch();

                // Verifica se a senha está correta
                if (password_verify($senha, $senha_hash)) {
                    // Armazena os dados na sessão
                    $_SESSION['id'] = $id;
                    $_SESSION['nome'] = $nome;
                    $_SESSION['loggedin'] = true;

                    // Redireciona para a página inicial
                    header("Location: index.php");
                    exit();
                } else {
                    echo "Senha incorreta!";
                }
            } else {
                echo "Nenhum usuário encontrado com esse e-mail.";
            }

            $stmt->close();
        }
    }
    ?>

    <!-- HTML do formulário de login -->
    <?php include "../config.php"; ?>
    <?php include "../comp/header.php"; ?>

    <div class="container-fluid" style="margin-top: 100px; margin-bottom: 100px;">
        <div class="row justify-content-center">
            <div class="card mb-3 border-danger col-xs-10 col-sm-8 col-md-8 col-lg-4 col-xl-4 p-5" style="background-color: rgba(0, 0, 0, 0.2);" data-bs-theme="dark" data-aos="fade-up">
                <div class="row g-0 p-5">
                    <form action="processa_login.php" method="POST" data-bs-theme="dark">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="exemplo@email.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="********" required>
                        </div>
                        <button type="submit" class="btn btn-danger mt-4">Entrar</button>
                    </form>
                </div>
                <div class="alert alert-danger" role="alert" id="error" style="display: none;">
                    Email ou senha inválidos!
                </div>
            </div>
        </div>
    </div>

    <?php include "../comp/footer.php"; ?>

