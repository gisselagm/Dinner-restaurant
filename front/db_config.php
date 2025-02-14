<?php
// db_config.php
$host = 'localhost';
$user = 'username';
$password = 'password';
$database = 'restaurante';

// Crear la conexión
$conn = new mysqli($host, $user, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}
?>
