🌍 Orizon Travel API

📌 Descrizione del Progetto
L'Orizon Travel API è un sistema RESTful che consente la gestione dei paesi e dei viaggi last-minute, con funzionalità per:

Aggiungere, modificare ed eliminare paesi.
Aggiungere, modificare ed eliminare viaggi associati a uno o più paesi.
Filtrare i viaggi per paese e numero di posti disponibili.
L'API è stata sviluppata in PHP con MySQL, testata con Postman e può essere facilmente integrata in un frontend o un'applicazione mobile.

🚀 Tecnologie Utilizzate

PHP (senza framework)
MySQL (per la gestione dei dati)
MAMP (server locale per macOS)
Postman (per il testing delle API)
GitHub (per la gestione del codice sorgente)
🛠 Setup del Progetto

📌 1️⃣ Installare MAMP e Configurare il Database
Apri MAMP e avvia Apache e MySQL.
Apri il browser e vai su http://localhost:8888/phpmyadmin.
Crea un database chiamato orizon_travel.
Importa il file migrations.sql per generare le tabelle.
📌 2️⃣ Configurare la Connessione al Database
Apri il file db.php e verifica che i dati siano corretti:

<?php
$host = "localhost";
$user = "root";
$password = "root";  // Password predefinita di MAMP
$database = "orizon_travel";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
?>
📡 Endpoints delle API

L'API segue le best practices REST e utilizza i metodi HTTP standard.

📌 Paesi (countries.php)
Metodo	Endpoint	Descrizione
GET	/countries.php	Ottiene tutti i paesi
POST	/countries.php	Aggiunge un nuovo paese
PUT	/countries.php?id={id}	Modifica un paese
DELETE	/countries.php?id={id}	Elimina un paese
📌 Esempio di richiesta (POST)

{
  "name": "Italia"
}
📌 Viaggi (trips.php)
Metodo	Endpoint	Descrizione
GET	/trips.php	Ottiene tutti i viaggi
GET	/trips.php?country_id={id}	Filtra viaggi per paese
GET	/trips.php?seats_available={numero}	Filtra viaggi per posti disponibili
POST	/trips.php	Aggiunge un nuovo viaggio
PUT	/trips.php?id={id}	Modifica un viaggio
DELETE	/trips.php?id={id}	Elimina un viaggio
📌 Esempio di richiesta (POST)

{
  "country_id": 1,
  "seats_available": 5
}
🔎 Test delle API con Postman

Esempio di test per ottenere tutti i paesi
Apri Postman.
Seleziona il metodo GET.
Inserisci l’URL:
http://localhost:8888/api/countries.php
Clicca su "Send".
Risultato atteso:
[
  { "id": 1, "name": "Italia" },
  { "id": 2, "name": "Francia" }
]
🛠 Error Handling & Status Code

L'API utilizza HTTP Status Code per indicare il risultato delle operazioni.

Status Code	Significato
200 OK	Richiesta eseguita con successo
201 Created	Risorsa creata con successo
400 Bad Request	Dati mancanti o non validi
404 Not Found	Risorsa non trovata
500 Internal Server Error	Errore lato server
📌 Come Aggiornare il Repository su GitHub

Ogni volta che apporti modifiche al progetto, aggiorna il repository con:

git add .
git commit -m "Descrizione delle modifiche"
git push origin main
💡 Conclusione

Questa API permette a Orizon Travel di gestire facilmente le offerte last-minute in modo flessibile e scalabile.
Grazie all’architettura REST, può essere facilmente integrata in qualsiasi frontend o applicazione mobile.
