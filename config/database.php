<?php
$host = "localhost";
$db   = "gestion_notes";
$user = "root";
$pass = "root123#";

$conn = mysqli_connect($host, $user, $pass, $db);
if (! $conn) {
    die("Erreur MySQLi : " . mysqli_connect_error());
}

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    // PDO MySQL driver may not be installed in CLI or environment, fall back to mysqli
    $pdo = null;
}
