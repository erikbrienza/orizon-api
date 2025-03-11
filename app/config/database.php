<?php

$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASSWORD = "root";
$DB_NAME = "orizon_travel";

// Connessione sicura al database
$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

// Controllo errori
if ($conn->connect_error) {
    die("❌ Connessione fallita: " . $conn->connect_error);
}

// Imposta il charset per evitare problemi di sicurezza
$conn->set_charset("utf8mb4");

?>
