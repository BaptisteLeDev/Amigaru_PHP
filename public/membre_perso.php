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
        JOIN user u ON p.user_id = u.id 
        WHERE p.id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $membreId, PDO::PARAM_INT);
$stmt->execute();
$pageData = $stmt->fetch();

if (!$pageData) {
    die('Erreur : Aucune page trouvée pour ce membre.');
}

$is_logged_in = isset($_SESSION['user_id']);
include __DIR__ . '/../assets/header.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageData['title'] ?? 'Page non trouvée'); ?></title>
    <link rel="stylesheet" href="output.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-neutral-900 text-white">
    <header class="text-center py-4">
        <h1 class="text-4xl font-bold"><?php echo htmlspecialchars($pageData['title'] ?? '@Pseudo'); ?></h1>
        <p class="text-lg">Créé par : <?php echo htmlspecialchars($pageData['username'] ?? 'Utilisateur inconnu'); ?></p>
    </header>

    <main>
        <!-- Section 1 -->
        <?php if (!empty($pageData['section1_title'])): ?>
            <section class="min-h-screen flex flex-col justify-center items-center p-16 bg-cover bg-center" style="background-image: url('img/hero.png');">
                <div class="flex flex-col md:flex-row items-center justify-center w-full max-w-6xl mx-auto">
                    <div class="md:w-1/2 p-4">
                        <h2 class="text-3xl font-bold mt-4"><?= htmlspecialchars($pageData['section1_title']); ?></h2>
                        <?php if (!empty($pageData['section1_text'])): ?>
                            <p class="text-lg mt-2"><?= htmlspecialchars($pageData['section1_text']); ?></p>
                        <?php endif; ?>
                    </div>
                    <?php if (!empty($pageData['section1_image'])): ?>
                        <div class="md:w-1/2 p-4">
                            <img src="<?= htmlspecialchars($pageData['section1_image']); ?>" alt="Image utilisateur" class="rounded-lg shadow-lg w-full h-auto">
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        <?php endif; ?>

        <!-- Section 2 -->
        <?php if (!empty($pageData['section2_title'])): ?>
            <section class="min-h-screen flex flex-col justify-center items-center p-16 bg-cover bg-center" style="background-image: url('img/hero.png');">
                <div class="flex flex-col md:flex-row items-center justify-center w-full max-w-6xl mx-auto">
                    <div class="md:w-1/2 p-4">
                        <h2 class="text-3xl font-bold mt-4"><?php echo htmlspecialchars($pageData['section2_title']); ?></h2>
                        <?php if (!empty($pageData['section2_text'])): ?>
                            <p class="text-lg mt-2"><?php echo htmlspecialchars($pageData['section2_text']); ?></p>
                        <?php endif; ?>
                    </div>
                    <?php if (!empty($pageData['section2_image'])): ?>
                        <div class="md:w-1/2 p-4">
                            <img src="<?= htmlspecialchars($pageData['section2_image']); ?>" alt="Image utilisateur" class="rounded-lg shadow-lg w-full h-auto">
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        <?php endif; ?>

        <!-- Section 3 (facultative) -->
        <?php if (!empty($pageData['section3_title'])): ?>
            <section class="p-8 lg:px-32 lg:py-16">
                <?php if (!empty($pageData['section3_image'])): ?>
                    <img src="<?= htmlspecialchars($pageData['section3_image']); ?>" alt="Section 3 Image" class="rounded-lg shadow-lg mb-4">
                <?php endif; ?>
                <h2 class="text-3xl font-bold mb-4"><?php echo htmlspecialchars($pageData['section3_title']); ?></h2>
                <?php if (!empty($pageData['section3_text'])): ?>
                    <p class="text-lg"><?php echo htmlspecialchars($pageData['section3_text']); ?></p>
                <?php endif; ?>
            </section>
        <?php endif; ?>

        <!-- Section 4 (facultative) -->
        <?php if (!empty($pageData['section4_title'])): ?>
            <section class="p-8 lg:px-32 lg:py-16">
                <h2 class="text-3xl font-bold mb-4"><?php echo htmlspecialchars($pageData['section4_title']); ?></h2>
                <?php if (!empty($pageData['section4_text'])): ?>
                    <p class="text-lg"><?php echo htmlspecialchars($pageData['section4_text']); ?></p>
                <?php endif; ?>
            </section>
        <?php endif; ?>

        <!-- Bannière (facultative) -->
        <?php if (!empty($pageData['section5_banner'])): ?>
            <footer class="p-8 lg:px-32 lg:py-16">
                <img src="<?= htmlspecialchars($pageData['section5_banner']); ?>" alt="Bannière" class="rounded-lg shadow-lg">
            </footer>
        <?php endif; ?>
    </main>

    <?php include __DIR__ . '/../assets/footer.php'; ?>
</body>
</html>