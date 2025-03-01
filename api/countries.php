<?php
require "db.php";

header ("Content-Type: application/json");
$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case 'GET':
        $sql = "SELECT * FROM countries";
        $result = $conn->query($sql);
        echo json_encode($result->fetch_all(MYSQLI_ASSOC));
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data['name'])) {
            http_response_code(400);
            echo json_encode(["message" => "Nome richiesto"]);
            exit;
        }
        $name = $conn->real_escape_string($data['name']);
        $sql = "INSERT INTO countries (name) VALUES ('$name')";
        if ($conn->query($sql)) {
            http_response_code(201);
            echo json_encode(["id" => $conn->insert_id, "name" => $name]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => $conn->error]);
        }
        break;

    case 'PUT':
        parse_str(file_get_contents("php://input"), $data);
        if (!isset($_GET['id']) || !isset($data['name'])) {
            http_response_code(400);
            echo json_encode(["message" => "Dati mancanti"]);
            exit;
        }
        $id = intval($_GET['id']);
        $name = $conn->real_escape_string($data['name']);
        $sql = "UPDATE countries SET name = '$name' WHERE id = $id";
        if ($conn->query($sql)) {
            echo json_encode(["message" => "Paese aggiornato"]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => $conn->error]);
        }
        break;

    case 'DELETE':
        if (!isset($_GET['id'])) {
            http_response_code(400);
            echo json_encode(["message" => "ID richiesto"]);
            exit;
        }
        $id = intval($_GET['id']);
        $sql = "DELETE FROM countries WHERE id = $id";
        if ($conn->query($sql)) {
            http_response_code(204);
        } else {
            http_response_code(500);
            echo json_encode(["message" => $conn->error]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(["message" => "Metodo non permesso"]);
}

?>