<?php
$host = "localhost";
$port = 3306;
$dbname = "amigaru_web";
$username = "root";
$password = "1234";

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    echo "Connexion réussie à la base de données !";
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

$password = password_hash("motdepasse123", PASSWORD_DEFAULT);
$query = $pdo->prepare("INSERT INTO user (username, email, password) VALUES (:username, :email, :password)");
$query->execute([
    'username' => 'testuser',
    'email' => 'test@example.com',
    'password' => $password,
]);
?>
