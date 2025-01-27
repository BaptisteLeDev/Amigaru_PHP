<?php
include '../config/db.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Vérifie si un ID de membre est passé dans l'URL
if (!isset($_GET['id'])) {
    die('Erreur : Aucun membre spécifié.');
}

// Récupère l'ID du membre depuis l'URL
$membreId = intval($_GET['id']);

// Requête SQL pour récupérer les données du membre
$sql = "SELECT p.*, u.username 
        FROM pages p 
        JOIN users u ON p.user_id = u.id 
        WHERE p.id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $membreId, PDO::PARAM_INT);
$stmt->execute();
$pageData = $stmt->fetch();

if (!$pageData) {
    die('Erreur : Aucune page trouvée pour ce membre.');
}
include __DIR__ . '/../assets/header.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageData['title']); ?></title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="output.css">
</head>

<body>
    <header>
        <h1><?php echo htmlspecialchars($pageData['title']?? '@Pseudo'); ?></h1>
        <p>Créé par : <?php echo htmlspecialchars($pageData['username']); ?></p>
    </header>

    <main>
        <!-- Section 1 -->
        <section>
            <img src="<?= htmlspecialchars($pageData['section1_image'] ?? 'default.jpg') ?>" alt="Image utilisateur">
            <h2><?= htmlspecialchars($pageData['section1_title'] ?? 'Bienvenue') ?></h2>
            <p><?= htmlspecialchars($pageData['section1_text'] ?? 'Texte par défaut') ?></p>
        </section>

        <!-- Section 2 -->
        <section>
            <h2><?php echo htmlspecialchars($pageData['section2_title']); ?></h2>
            <p><?php echo htmlspecialchars($pageData['section2_text']); ?></p>
        </section>

        <!-- Section 3 (facultative) -->
        <?php if (!empty($pageData['section3_title']) && !empty($pageData['section3_text'])): ?>
            <section>
                <?php if (!empty($pageData['section3_image'])): ?>
                    <img src="images/<?php echo htmlspecialchars($pageData['section3_image']); ?>" alt="Section 3 Image">
                <?php endif; ?>
                <h2><?php echo htmlspecialchars($pageData['section3_title']); ?></h2>
                <p><?php echo htmlspecialchars($pageData['section3_text']); ?></p>
            </section>
        <?php endif; ?>

        <!-- Section 4 (facultative) -->
        <?php if (!empty($pageData['section4_title']) && !empty($pageData['section4_text'])): ?>
            <section>
                <h2><?php echo htmlspecialchars($pageData['section4_title']); ?></h2>
                <p><?php echo htmlspecialchars($pageData['section4_text']); ?></p>
            </section>
        <?php endif; ?>

        <!-- Bannière (facultative) -->
        <?php if (!empty($pageData['section5_banner'])): ?>
            <footer>
                <img src="images/<?php echo htmlspecialchars($pageData['section5_banner']); ?>" alt="Bannière">
            </footer>
        <?php endif; ?>
    </main>
</body>

</html>