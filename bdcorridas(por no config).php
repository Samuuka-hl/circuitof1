<?php
// Função para fazer requisições à API Ergast e inserir os dados no banco
function fetchAndInsertData($year, $conn) {
    $url = "https://ergast.com/api/f1/$year/results/1.json";
    $json = file_get_contents($url);
    $data = json_decode($json, true);
    
    if (isset($data['MRData']['RaceTable']['Races'])) {
        foreach ($data['MRData']['RaceTable']['Races'] as $race) {
            $grand_prix = $race['raceName'];
            $date = $race['date'];
            $winner = $race['Results'][0]['Driver']['givenName'] . " " . $race['Results'][0]['Driver']['familyName'];
            $car = $race['Results'][0]['Constructor']['name'];
            $laps = $race['Results'][0]['laps'];
            $time = isset($race['Results'][0]['Time']['time']) ? $race['Results'][0]['Time']['time'] : 'N/A';

            // Inserir os dados na tabela races
            $stmt = $conn->prepare("INSERT INTO races (year, grand_prix, date, winner, car, laps, time) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issssis", $year, $grand_prix, $date, $winner, $car, $laps, $time);
            $stmt->execute();
        }
        //echo "Dados do ano $year inseridos com sucesso.<br>";
    } else {
        echo "Nenhum dado encontrado para o ano $year.<br>";
    }
}

// Loop para buscar e inserir dados de cada ano de 1950 a 2024
for ($year = 1950; $year <= 2024; $year++) {
    fetchAndInsertData($year, $conn);
}

$conn->close();
?>