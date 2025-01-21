<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'amigaru_web';
$username = 'root';
$password = '1234';  // Remplace par ton mot de passe si nécessaire

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
    exit;
}

// Récupérer les utilisateurs avec le rôle "streamer" et leur ID
$query = "SELECT id, username FROM users WHERE role = 'streamer'";
$stmt = $pdo->prepare($query);
$stmt->execute();

// Affichage des résultats
$streamers = $stmt->fetchAll(PDO::FETCH_ASSOC);
include __DIR__ . '/../assets/header.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membres Amigaru - Streameurs</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Membres Amigaru - Streameurs</h1>
    <p>Voici la liste des streameurs d'Amigaru :</p>

    <ul class="streamer-list">
        <?php
        foreach ($streamers as $streamer) {
            // Afficher chaque streamer avec un lien vers leur page perso
            echo '<li class="streamer">';
            echo htmlspecialchars($streamer['username']); // Affiche le pseudo
            // Création du lien vers la page perso de chaque membre
            echo ' <a href="membre_perso.php?id=' . htmlspecialchars($streamer['id']) . '">Voir le profil</a>';
            echo '</li>';
        }
        ?>
    </ul>
</body>
</html>
