<?php

$database_settings = [
    'host' => $_ENV['DB_HOST'] ?? "",
    'database' => $_ENV['DB_DATABASE'] ?? "",
    'username' => $_ENV['DB_USER'] ?? "",
    'password' => $_ENV['DB_PASSWORD'] ?? "",
];
