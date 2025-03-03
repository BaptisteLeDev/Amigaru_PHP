<?php
// Configuration de la connexion à la base de données
$host = '127.0.0.1'; // ou 'localhost'
$dbname = 'amigaru_web'; // Remplacez par le nom de votre base de données
$user = 'root'; // Par défaut sous Laragon
$pass = '1234'; // Par défaut sous Laragon (aucun mot de passe)

// Création de la connexion PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Liste des utilisateurs avec leurs mots de passe bruts
$passwords = [
    'Studioos' => 'password123',
    'Shyrrotsuki' => 'stream456',
];

// Préparation de la requête d'insertion
$sql = "INSERT INTO `user` (`username`, `email`, `password`, `role`, `statut`) VALUES (:username, :email, :password, 'streamer', NULL)";
$stmt = $pdo->prepare($sql);

// Boucle pour insérer chaque utilisateur
foreach ($passwords as $username => $rawPassword) {
    // Hachage du mot de passe
    $hashedPassword = password_hash($rawPassword, PASSWORD_DEFAULT);

    // Exécution de la requête avec les paramètres
    $stmt->execute([
        ':username' => $username,
        ':email' => $username . '@example.com',
        ':password' => $hashedPassword,
    ]);

    echo "Utilisateur $username inséré avec succès.<br>";
}
