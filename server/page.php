<?php
// Inclusion de la connexion à la base de données
require 'db.php';

// Vérification de l'identifiant de la page dans l'URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Aucune page spécifiée.");
}

// Récupération de l'ID de la page
$page_id = intval($_GET['id']);

// Requête pour récupérer les informations de la page
$query = $pdo->prepare("SELECT * FROM Pages WHERE id = :id");
$query->execute(['id' => $page_id]);
$page = $query->fetch(PDO::FETCH_ASSOC);

if (!$page) {
    die("Page introuvable.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page['title']); ?></title>
</head>
<body>
    <h1><?php echo htmlspecialchars($page['title']); ?></h1>
    
    <!-- Section 1 -->
    <?php if (!empty($page['section1_image'])): ?>
        <img src="uploads/<?php echo htmlspecialchars($page['section1_image']); ?>" alt="Section 1">
    <?php endif; ?>
    <h2><?php echo htmlspecialchars($page['section1_title']); ?></h2>
    <p><?php echo nl2br(htmlspecialchars($page['section1_text'])); ?></p>

    <!-- Section 2 -->
    <h2><?php echo htmlspecialchars($page['section2_title']); ?></h2>
    <p><?php echo nl2br(htmlspecialchars($page['section2_text'])); ?></p>

    <!-- Section 3 -->
    <?php if (!empty($page['section3_image'])): ?>
        <img src="uploads/<?php echo htmlspecialchars($page['section3_image']); ?>" alt="Section 3">
    <?php endif; ?>
    <h2><?php echo htmlspecialchars($page['section3_title']); ?></h2>
    <p><?php echo nl2br(htmlspecialchars($page['section3_text'])); ?></p>

    <!-- Section 4 -->
    <h2><?php echo htmlspecialchars($page['section4_title']); ?></h2>
    <p><?php echo nl2br(htmlspecialchars($page['section4_text'])); ?></p>

    <!-- Section 5 -->
    <?php if (!empty($page['section5_banner'])): ?>
        <img src="uploads/<?php echo htmlspecialchars($page['section5_banner']); ?>" alt="Section 5">
    <?php endif; ?>
</body>
</html>
