<?php

// Session
session_start();

// Load routes from config/routes.json
$routes = json_decode(file_get_contents(__DIR__ . '/routes.json'), true);

// Vérifier si un fichier .env.local existe et charger par défaut
$envFilePath = __DIR__ . '/../.env.local';

// Si le fichier .env.local existe, le charger par défaut
if (file_exists($envFilePath)) {
    $dotenv = Dotenv\Dotenv::createImmutable('../', '.env.local');
} else {
    // Sinon, charger le fichier .env standard
    $dotenv = Dotenv\Dotenv::createImmutable('../', '.env');
}

$dotenv->load();