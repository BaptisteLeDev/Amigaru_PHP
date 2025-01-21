<?php
$dotenv = parse_ini_file('../config/.env');

$host = $dotenv['DB_HOST'];
$port = $dotenv['DB_PORT'];
$dbname = $dotenv['DB_NAME'];
$user = $dotenv['DB_USER'];
$password = $dotenv['DB_PASS'];

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
