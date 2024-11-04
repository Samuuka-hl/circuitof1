<?php
// Conexão com o banco de dados
$host = 'localhost';
$db = 'circuito';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtém o ano da requisição
$year = isset($_GET['year']) ? intval($_GET['year']) : 2024;

// Consulta para obter as corridas do ano selecionado
$sql = "SELECT grand_prix, date, winner, car, laps, time FROM races WHERE year = $year ORDER BY date";
$result = $conn->query($sql);

// Gera a tabela com os dados obtidos
if ($result->num_rows > 0) {
    echo '<div class="row justify-content-center">';
    echo '<table class="table mb-3 w-50" data-bs-theme="dark" >';
    echo '<thead class="">';
    echo '<tr class="text-danger">';
    echo '<th class="text-danger text-center" scope="col" style="background-color: rgba(0, 0, 0, 0.5);">GP</th>';
    echo '<th class="text-danger text-center" scope="col" style="background-color: rgba(0, 0, 0, 0.5);">Data</th>';
    echo '<th class="text-danger text-center" scope="col" style="background-color: rgba(0, 0, 0, 0.5);">Vencedor</th>';
    echo '<th class="text-danger text-center" scope="col" style="background-color: rgba(0, 0, 0, 0.5);">Carro</th>';
    echo '<th class="text-danger text-center" scope="col" style="background-color: rgba(0, 0, 0, 0.5);">Laps</th>';
    echo '<th class="text-danger text-center" scope="col" style="background-color: rgba(0, 0, 0, 0.5);">Tempo</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';


    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<th class="text-center" scope="row" style="background-color: rgba(0, 0, 0, 0.5);">' . $row["grand_prix"] . '</th>';
        echo '<td class="text-center" style="background-color: rgba(0, 0, 0, 0.5);">' . date("d M Y", strtotime($row["date"])) . '</td>';
        echo '<td class="text-center" style="background-color: rgba(0, 0, 0, 0.5);">' . $row["winner"] . '</td>';
        echo '<td class="text-center" style="background-color: rgba(0, 0, 0, 0.5);">' . $row["car"] . '</td>';
        echo '<td class="text-center" style="background-color: rgba(0, 0, 0, 0.5);">' . $row["laps"] . '</td>';
        echo '<td class="text-center" style="background-color: rgba(0, 0, 0, 0.5);">' . $row["time"] . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';

} else {
    echo "<p>Sem dados para o ano selecionado.</p>";
}

$conn->close();
?>
