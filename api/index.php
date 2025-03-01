<?php
header("Content-Type: application/json");

echo json_encode([
    "message" => "Benvenuto nelle API di Orizon Travel",
    "endpoints" => [
        "GET /countries.php" => "Visualizza tutti i paesi",
        "POST /countries.php" => "Aggiungi un nuovo paese",
        "PUT /countries.php?id={id}" => "Aggiorna un paese esistente",
        "DELETE /countries.php?id={id}" => "Elimina un paese",
        "GET /trips.php" => "Visualizza tutti i viaggi",
        "GET /trips.php?country_id={id}" => "Filtra viaggi per paese",
        "GET /trips.php?seats_available={numero}" => "Filtra viaggi per posti disponibili",
        "POST /trips.php" => "Aggiungi un nuovo viaggio",
        "PUT /trips.php?id={id}" => "Aggiorna un viaggio esistente",
        "DELETE /trips.php?id={id}" => "Elimina un viaggio"
    ]
], JSON_PRETTY_PRINT);
?>