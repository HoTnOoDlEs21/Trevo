<?php
$host     = "localhost";      // ou 127.0.0.1
$usuario  = "root";           // substitui se tiveres outro user
$password = "";               // insere tua password se tiver
$database = "centro_trevo";   // nome da tua base de dados

// Cria ligação
$conn = new mysqli($host, $usuario, $password, $database);

// Verifica ligação
if ($conn->connect_error) {
    die("Falha na ligação: " . $conn->connect_error);
}

// Define charset
$conn->set_charset("utf8mb4");
