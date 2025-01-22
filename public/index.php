<?php
include __DIR__ . '/../config/db.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!$pdo) {
    die("Erreur de connexion à la base de données.");
}
include __DIR__ . '/../assets/header.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amigaru - Accueil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Bienvenue sur Amigaru</h1>
        <p>Découvrez nos streameurs et rejoignez-nous !</p>
    </header>

    <main>
        <a href="nos_membres.php">Voir les membres</a>
    </main>

    <?php include __DIR__ . '/../assets/footer.php'; ?>
</body>
</html>
