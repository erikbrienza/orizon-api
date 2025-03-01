<?php
require 'db.php';

header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $conditions = [];
        if (isset($_GET['country_id'])) {
            $conditions[] = "country_id = " . intval($_GET['country_id']);
        }
        if (isset($_GET['seats_available'])) {
            $conditions[] = "seats_available >= " . intval($_GET['seats_available']);
        }
        $where = !empty($conditions) ? " WHERE " . implode(" AND ", $conditions) : "";
        $sql = "SELECT * FROM trips" . $where;
        $result = $conn->query($sql);
        echo json_encode($result->fetch_all(MYSQLI_ASSOC));
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data['country_id']) || !isset($data['seats_available'])) {
            http_response_code(400);
            echo json_encode(["message" => "Dati mancanti"]);
            exit;
        }
        $country_id = intval($data['country_id']);
        $seats_available = intval($data['seats_available']);
        $sql = "INSERT INTO trips (country_id, seats_available) VALUES ($country_id, $seats_available)";
        if ($conn->query($sql)) {
            http_response_code(201);
            echo json_encode(["id" => $conn->insert_id, "country_id" => $country_id, "seats_available" => $seats_available]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => $conn->error]);
        }
        break;

    case 'PUT':
        parse_str(file_get_contents("php://input"), $data);
        if (!isset($_GET['id']) || !isset($data['country_id']) || !isset($data['seats_available'])) {
            http_response_code(400);
            echo json_encode(["message" => "Dati mancanti"]);
            exit;
        }
        $id = intval($_GET['id']);
        $country_id = intval($data['country_id']);
        $seats_available = intval($data['seats_available']);
        $sql = "UPDATE trips SET country_id = $country_id, seats_available = $seats_available WHERE id = $id";
        if ($conn->query($sql)) {
            echo json_encode(["message" => "Viaggio aggiornato"]);
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
        $sql = "DELETE FROM trips WHERE id = $id";
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