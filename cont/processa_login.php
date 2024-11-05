<?php
include "../config.php";

// Inicia a sessão
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se os dados do formulário foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Prepara a consulta SQL
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    
    // Executa a consulta
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        
        // Verifica se o usuário existe
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Verifica se a senha está correta
            if (password_verify($senha, $user['senha'])) {
                // Armazena os dados do usuário na sessão
                $_SESSION['loggedin'] = true;
                $_SESSION['usuario_id'] = $user['id'];
                $_SESSION['nome'] = $user['nome'];
                $_SESSION['email'] = $user['email'];

                // Redireciona para a página de perfil ou inicial
                header("Location: perfil.php");
                exit();
            } else {
                // Senha incorreta
                echo "<script>
                    alert('Senha incorreta!');
                    window.history.back();
                </script>";
            }
        } else {
            // Usuário não encontrado
            echo "<script>
                alert('Email não encontrado!');
                window.history.back();
            </script>";
        }
    } else {
        echo "<script>
            alert('Erro ao executar a consulta!');
            window.history.back();
        </script>";
    }

    // Fecha a declaração
    $stmt->close();
}

// Fecha a conexão
$conn->close();
?>
