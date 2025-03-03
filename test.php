<?php
try {
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=amigaru_web', 'root', '1234');
    echo 'Connexion réussie à la base de données.';
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
}
?>
