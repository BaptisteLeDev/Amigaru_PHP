<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'amigaru_web';
$username = 'root';
$password = '1234'; // Remplace par ton mot de passe si nécessaire

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
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="output.css">
</head>

<body class="bg-neutral-900 text-white">

    <!-- Section Header -->
    <section class="min-h-[40vh] flex flex-col justify-center items-center p-16" style="background-image: url('img/hero.png');
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
  width: 100%;
 ">
        <h1 class="text-4xl font-bold mb-4">Membres Amigaru</h1>
        <p class="text-lg">Découvrez les streameurs de notre communauté</p>
    </section>

    <!-- Liste des streameurs -->
    <section class="p-8 lg:px-[200px] lg:py-[100px]">
        <h2 class="text-3xl font-bold text-center mb-8">Nos Streameurs</h2>
        <ul class="space-y-4">
            <?php foreach ($streamers as $streamer) : ?>
                <li class="bg-gray-800 p-4 rounded-lg shadow-md flex items-center justify-between">
                    <span class="text-lg font-semibold"><?= htmlspecialchars($streamer['username']); ?></span>
                    <a href="membre_perso.php?id=<?= htmlspecialchars($streamer['id']); ?>"
                        class="bg-blue-600 text-white py-2 px-4 rounded-lg shadow-lg hover:bg-blue-700">
                        Voir le profil
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>

    <!-- Footer -->
    <?php include __DIR__ . '/../assets/footer.php'; ?>

</body>

</html>
