<?php

require_once '../app/models/Country.php';

class CountriesController
{
    public static function getAll()
    {
        echo json_encode(Country::getAll());
    }

    public static function getById()
    {
        if (!isset($_GET['id'])) {
            http_response_code(400);
            echo json_encode(['message' => 'ID richiesto']);
            return;
        }
        echo json_encode(Country::getById($_GET['id']));
    }

    public static function create()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data['name'])) {
            http_response_code(400);
            echo json_encode(['message' => 'Il nome è richiesto']);
            return;
        }
        Country::create($data['name']);
        http_response_code(201);
        echo json_encode(['message' => 'Paese creato con successo']);
    }

    public static function update()
    {
        parse_str(file_get_contents("php://input"), $data);
        if (!isset($_GET['id']) || !isset($data['name'])) {
            http_response_code(400);
            echo json_encode(['message' => 'Dati mancanti']);
            return;
        }
        Country::update($_GET['id'], $data['name']);
        echo json_encode(['message' => 'Paese aggiornato']);
    }

    public static function delete()
    {
        if (!isset($_GET['id'])) {
            http_response_code(400);
            echo json_encode(['message' => 'ID richiesto']);
            return;
        }
        Country::delete($_GET['id']);
        http_response_code(204);
    }
}