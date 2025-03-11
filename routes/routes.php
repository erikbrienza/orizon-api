<?php

require_once '../app/controllers/CountriesController.php';
require_once '../app/controllers/TripsController.php';

function handleRequest($uri, $method) {
    $routes = [
        'GET' => [
            '/countries' => 'CountriesController::getAll',
            '/countries/:id' => 'CountriesController::getById', 
            '/trips' => 'TripsController::getAll',
            '/trips/:id' => 'TripsController::getById' 
        ],
        'POST' => [
            '/countries' => 'CountriesController::create',
            '/trips' => 'TripsController::create'
        ],
        'PUT' => [
            '/countries/:id' => 'CountriesController::update', 
            '/trips/:id' => 'TripsController::update' 
        ],
        'DELETE' => [
            '/countries/:id' => 'CountriesController::delete', 
            '/trips/:id' => 'TripsController::delete'
        ]
    ];

    $parsedUrl = parse_url($uri);
    $path = rtrim($parsedUrl['path'], '/');
    
    // Gestire le route con ID dinamici
    if (preg_match('/\/countries\/(\d+)/', $path, $matches)) {
        $_GET['id'] = $matches[1]; 
        $path = '/countries/:id';
    }
    if (preg_match('/\/trips\/(\d+)/', $path, $matches)) {
        $_GET['id'] = $matches[1];
        $path = '/trips/:id';
    }

    // Verifica se la route esiste
    if (isset($routes[$method][$path])) {
        call_user_func($routes[$method][$path]);
    } else {
        http_response_code(404);
        echo json_encode(['message' => 'Route not found']);
    }
}