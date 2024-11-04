<?php
// Inicia a sessão se não estiver ativa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = ""; // Altere se necessário
$dbname = "circuito";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Define a constante BASEURL, se não estiver definida
if (!defined("BASEURL")) {
    define("BASEURL", "/circuitof1/");
}
?>


