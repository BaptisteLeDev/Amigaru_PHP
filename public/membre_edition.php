<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include __DIR__ . '/../config/db.php';

// Vérifier l'ID de la page dans l'URL
if (!isset($_GET['id'])) {
    die('Aucune page sélectionnée.');
}

$page_id = (int)$_GET['id'];

// Récupérer les informations de la page
$query = "SELECT * FROM pages WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id', $page_id, PDO::PARAM_INT);
$stmt->execute();
$page = $stmt->fetch(PDO::FETCH_ASSOC);

// Contenu par défaut pour les champs vides
$default_values = [
    'title' => 'Titre de la section',
    'section1_image' => '',
    'section1_title' => 'Titre de la section 1',
    'section1_text' => 'Contenu de la section 1',
    'section2_title' => 'Titre de la section 2',
    'section2_text' => 'Contenu de la section 2',
    'section2_image' => '',
    'section3_image' => '',
    'section3_title' => 'Titre de la section 3',
    'section3_text' => 'Contenu de la section 3',
    'section4_title' => 'Titre de la section 4',
    'section4_text' => 'Contenu de la section 4',
    'section5_banner' => '',
];

// Remplir les champs avec les valeurs existantes ou les valeurs par défaut
foreach ($default_values as $key => $default) {
    if (empty($page[$key])) {
        $page[$key] = $default;
    }
}

// Sauvegarder les modifications
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fields = ['title', 'section1_image', 'section1_title', 'section1_text', 'section2_title', 'section2_text', 'section2_image', 'section3_image', 'section3_title', 'section3_text', 'section4_title', 'section4_text', 'section5_banner'];
    $update_query = "UPDATE pages SET ";

    foreach ($fields as $field) {
        $update_query .= "$field = :$field, ";
    }
    $update_query = rtrim($update_query, ', ') . " WHERE id = :id";

    $update_stmt = $pdo->prepare($update_query);
    foreach ($fields as $field) {
        $update_stmt->bindValue(":$field", $_POST[$field] ?? '', PDO::PARAM_STR);
    }
    $update_stmt->bindValue(':id', $page_id, PDO::PARAM_INT);

    if ($update_stmt->execute()) {
        echo '<p style="color: green;">Page mise à jour avec succès !</p>';
        // Recharger les données pour refléter les modifications
        header("Location: membre_edition.php?id=$page_id");
        exit;
    } else {
        echo '<p style="color: red;">Erreur lors de la mise à jour.</p>';
    }
}

$is_logged_in = isset($_SESSION['user_id']);
include __DIR__ . '/../assets/header.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Édition de la page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="output.css">
</head>
<body class="bg-neutral-900 text-white">
    <!-- Section Header -->
    <section class="min-h-[40vh] flex flex-col justify-center items-center p-16" style="background-image: url('img/hero.png');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        width: 100%;">
        <h1 class="text-4xl font-bold mb-4 mt-10">Édition de la Page</h1>
        <p class="text-lg">Modifiez les sections de la page pour refléter votre contenu</p>
    </section>

    <!-- Formulaire d'édition -->
    <section class="p-8 lg:px-[200px] lg:py-[100px]">
        <form method="POST" class="bg-gray-800 p-6 rounded-lg shadow-md space-y-8">
            <!-- Titre de la page -->
            <div>
                <label for="title" class="block text-lg font-semibold mb-2">Titre de la page</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($page['title']); ?>" class="w-full p-3 rounded-md bg-gray-700 text-white focus:ring focus:ring-blue-500">
            </div>

            <!-- Section 1 -->
            <div>
                <h2 class="text-2xl font-bold mb-4">Section 1</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="section1_image" class="block text-lg font-semibold mb-2">Image</label>
                        <input type="text" id="section1_image" name="section1_image" value="<?php echo htmlspecialchars($page['section1_image']); ?>" class="w-full p-3 rounded-md bg-gray-700 text-white focus:ring focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="section1_title" class="block text-lg font-semibold mb-2">Titre</label>
                        <input type="text" id="section1_title" name="section1_title" value="<?php echo htmlspecialchars($page['section1_title']); ?>" class="w-full p-3 rounded-md bg-gray-700 text-white focus:ring focus:ring-blue-500">
                    </div>
                </div>
                <div class="mt-4">
                    <label for="section1_text" class="block text-lg font-semibold mb-2">Texte</label>
                    <textarea id="section1_text" name="section1_text" rows="4" class="w-full p-3 rounded-md bg-gray-700 text-white focus:ring focus:ring-blue-500"><?php echo htmlspecialchars($page['section1_text']); ?></textarea>
                </div>
            </div>

            <!-- Section 2 -->
            <div>
                <h2 class="text-2xl font-bold mb-4">Section 2</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="section2_image" class="block text-lg font-semibold mb-2">Image</label>
                        <input type="text" id="section2_image" name="section2_image" value="<?php echo htmlspecialchars($page['section2_image']); ?>" class="w-full p-3 rounded-md bg-gray-700 text-white focus:ring focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="section2_title" class="block text-lg font-semibold mb-2">Titre</label>
                        <input type="text" id="section2_title" name="section2_title" value="<?php echo htmlspecialchars($page['section2_title']); ?>" class="w-full p-3 rounded-md bg-gray-700 text-white focus:ring focus:ring-blue-500">
                    </div>
                </div>
                <div class="mt-4">
                    <label for="section2_text" class="block text-lg font-semibold mb-2">Texte</label>
                    <textarea id="section2_text" name="section2_text" rows="4" class="w-full p-3 rounded-md bg-gray-700 text-white focus:ring focus:ring-blue-500"><?php echo htmlspecialchars($page['section2_text']); ?></textarea>
                </div>
            </div>

            <!-- Section 3 -->
            <div>
                <h2 class="text-2xl font-bold mb-4">Section 3</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="section3_image" class="block text-lg font-semibold mb-2">Image</label>
                        <input type="text" id="section3_image" name="section3_image" value="<?php echo htmlspecialchars($page['section3_image']); ?>" class="w-full p-3 rounded-md bg-gray-700 text-white focus:ring focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="section3_title" class="block text-lg font-semibold mb-2">Titre</label>
                        <input type="text" id="section3_title" name="section3_title" value="<?php echo htmlspecialchars($page['section3_title']); ?>" class="w-full p-3 rounded-md bg-gray-700 text-white focus:ring focus:ring-blue-500">
                    </div>
                </div>
                <div class="mt-4">
                    <label for="section3_text" class="block text-lg font-semibold mb-2">Texte</label>
                    <textarea id="section3_text" name="section3_text" rows="4" class="w-full p-3 rounded-md bg-gray-700 text-white focus:ring focus:ring-blue-500"><?php echo htmlspecialchars($page['section3_text']); ?></textarea>
                </div>
            </div>

            <!-- Section 4 -->
            <div>
                <h2 class="text-2xl font-bold mb-4">Section 4</h2>
                <div>
                    <label for="section4_title" class="block text-lg font-semibold mb-2">Titre</label>
                    <input type="text" id="section4_title" name="section4_title" value="<?php echo htmlspecialchars($page['section4_title']); ?>" class="w-full p-3 rounded-md bg-gray-700 text-white focus:ring focus:ring-blue-500">
                </div>
                <div class="mt-4">
                    <label for="section4_text" class="block text-lg font-semibold mb-2">Texte</label>
                    <textarea id="section4_text" name="section4_text" rows="4" class="w-full p-3 rounded-md bg-gray-700 text-white focus:ring focus:ring-blue-500"><?php echo htmlspecialchars($page['section4_text']); ?></textarea>
                </div>
            </div>

            <!-- Bannière -->
            <div>
                <h2 class="text-2xl font-bold mb-4">Bannière</h2>
                <div>
                    <label for="section5_banner" class="block text-lg font-semibold mb-2">Bannière</label>
                    <input type="text" id="section5_banner" name="section5_banner" value="<?php echo htmlspecialchars($page['section5_banner']); ?>" class="w-full p-3 rounded-md bg-gray-700 text-white focus:ring focus:ring-blue-500">
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-center mt-8">
                <button type="submit" class="px-6 py-3 bg-blue-600 rounded-lg text-white font-semibold shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Sauvegarder les modifications
                </button>
            </div>
        </form>
    </section>

    <!-- Footer -->
<<<<<<< HEAD
    <footer class="text-center py-4 mt-8 bg-neutral-800 text-gray-400">
        <p>&copy; 2025 Amigaru. Tous droits réservés.</p>
    </footer>
</body>

=======
    <?php include __DIR__ . '/../assets/footer.php'; ?>
</body>
>>>>>>> No-MVC
</html>
