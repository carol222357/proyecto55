<?php



$conn = new mysqli("127.0.0.1", "root", "", "cecal");

if ($conn->connect_error) {
    die("Error de conexión" . $conn->connect_error);
}