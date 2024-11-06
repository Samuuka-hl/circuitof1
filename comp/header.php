<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="descrição">
    <meta name="keywords" content="Palavras Chave">
    <meta name="author" content="Samuca e Thatha">

    <link rel="icon" type="image/x-icon" href="<?php echo BASEURL; ?>img/icon/f1icon.png">
    <link rel="stylesheet" href="<?php echo BASEURL; ?>bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo BASEURL; ?>awesome/all.min.css">
    <link rel="stylesheet" href="<?php echo BASEURL; ?>style/css.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <title>Circuito F1</title>

    <style>
        body{
            background-image: url("<?php echo BASEURL; ?>img/bgcf1.jpg");
            background-attachment:fixed;
            background-size: cover;
        }

        @font-face{
            font-family: Formula1-Regular;
            src: url("<?php echo BASEURL; ?>style/font/Formula1-Regular.otf") format('truetype');
        }

        h1, h2, a{
            font-family:Formula1-Regular;
        }
        
        .bg2{
                background-image: url("../img/camp.jpg");
                background-position:center;
                backdrop-filter: blur(5px);
                background-size: cover;
        }
    </style>

</head>

<body class="bg-dark">

    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-secondary-subtle border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo BASEURL; ?>index.php"><img src="<?php echo BASEURL; ?>img/icon/f1icon.png" class="ms-2" style="width:2vw; height:auto;"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto me-auto align-center">
                    <li class="nav-item mx-3">
                        <a class="nav-link cool-link" aria-current="page" href="<?php echo BASEURL; ?>cont/campeonatos.php">Campeonatos</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link cool-link" href="<?php echo BASEURL; ?>cont/com/comunidade.php">Comunidade</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link cool-link" href="<?php echo BASEURL; ?>cont/historia.php">História</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link cool-link" href="https://f1store.formula1.com/en/" target="_blank">Loja</a>
                    </li>
                </ul>

                <div class="d-flex text-light">
                    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                        <a class="nav-link me-3 bg-dark p-1 px-2 rounded-3" href="<?php echo BASEURL; ?>cont/perfil.php">Meu Perfil</a>
                        <a class="nav-link me-3 p-1" href="<?php echo BASEURL; ?>cont/logout.php"><i class="fa-solid fa-sign-out-alt"></i></a>
                    <?php else: ?>
                        <a class="nav-link me-3 bg-dark p-1 px-2 rounded-3" href="<?php echo BASEURL; ?>cont/login.php">Entrar</a>
                        <a class="nav-link me-3 p-1" href="<?php echo BASEURL; ?>cont/formulario_cadastro.php" alt="Logar"><i class="fa-solid fa-user-plus"></i></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
