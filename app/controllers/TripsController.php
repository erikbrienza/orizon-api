<?php

require_once '../app/models/Trip.php';

class TripsController
{
    public static function getAll()
    {
        echo json_encode(Trip::getAll());
    }

    public static function getById()
    {
        if (!isset($_GET['id'])) {
            http_response_code(400);
            echo json_encode(['message' => 'ID richiesto']);
            return;
        }
        echo json_encode(Trip::getById($_GET['id']));
    }

    public static function create()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data['country_id']) || !isset($data['seats_available'])) {
            http_response_code(400);
            echo json_encode(['message' => 'Dati mancanti']);
            return;
        }
        Trip::create($data['country_id'], $data['seats_available']);
        http_response_code(201);
        echo json_encode(['message' => 'Viaggio creato con successo']);
    }

    public static function update()
    {
        parse_str(file_get_contents("php://input"), $data);
        if (!isset($_GET['id']) || !isset($data['country_id']) || !isset($data['seats_available'])) {
            http_response_code(400);
            echo json_encode(['message' => 'Dati mancanti']);
            return;
        }
        Trip::update($_GET['id'], $data['country_id'], $data['seats_available']);
        echo json_encode(['message' => 'Viaggio aggiornato']);
    }

    public static function delete()
    {
        if (!isset($_GET['id'])) {
            http_response_code(400);
            echo json_encode(['message' => 'ID richiesto']);
            return;
        }
        Trip::delete($_GET['id']);
        http_response_code(204);
    }
}