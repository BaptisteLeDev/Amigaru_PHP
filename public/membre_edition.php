<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'amigaru_web';
$username = 'root';
$password = '1234';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
    exit;
}

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
    $fields = ['title', 'section1_image', 'section1_title', 'section1_text', 'section2_title', 'section2_text', 'section3_image', 'section3_title', 'section3_text', 'section4_title', 'section4_text', 'section5_banner'];
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
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Édition de la page</title>
    <style>
        body {
            background-color: #1E1E1E;
            color: white;
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #444;
            background-color: #333;
            color: white;
        }
        textarea {
            resize: vertical;
            height: 100px;
        }
        button {
            padding: 10px 20px;
            background-color: #444;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <h1>Édition de la page</h1>
    <h1>Section 1</h1>
    <form method="POST">
        <div class="form-group">
            <label for="title">Titre de la page</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($page['title']); ?>">
        </div>
        <div class="form-group">
            <label for="section1_image">Image de la section 1</label>
            <input type="text" id="section1_image" name="section1_image" value="<?php echo htmlspecialchars($page['section1_image']); ?>">
        </div>
        <div class="form-group">
            <label for="section1_title">Titre de la section 1</label>
            <input type="text" id="section1_title" name="section1_title" value="<?php echo htmlspecialchars($page['section1_title']); ?>">
        </div>
        <div class="form-group">
            <label for="section1_text">Texte de la section 1</label>
            <textarea id="section1_text" name="section1_text"><?php echo htmlspecialchars($page['section1_text']); ?></textarea>
        </div>
        <button type="submit">Sauvegarder</button>
    </form>
    <h1>Section 2</h1>
    <form method="POST">
        <div class="form-group">
            <label for="section2_title">Titre de la section 2</label>
            <input type="text" id="section1_title" name="section1_title" value="<?php echo htmlspecialchars($page['section2_title']); ?>">
        </div>
        <div class="form-group">
            <label for="section2_text">Texte de la section 2</label>
            <textarea id="section2_text" name="section2_text"><?php echo htmlspecialchars($page['section2_text']); ?></textarea>
        </div>
        <button type="submit">Sauvegarder</button>
    </form>
    <h1>Section 3</h1>
    <form method="POST">
        <div class="form-group">
            <label for="section3_image">Image de la section 3</label>
            <input type="text" id="section3_image" name="section3_image" value="<?php echo htmlspecialchars($page['section3_image']); ?>">
        </div>
        <div class="form-group">
            <label for="section3_title">Titre de la section 3</label>
            <input type="text" id="section3_title" name="section3_title" value="<?php echo htmlspecialchars($page['section3_title']); ?>">
        </div>
        <div class="form-group">
            <label for="section3_text">Texte de la section 3</label>
            <textarea id="section3_text" name="section3_text"><?php echo htmlspecialchars($page['section3_text']); ?></textarea>
        </div>
        <button type="submit">Sauvegarder</button>
    </form>
    <h1>Section 4</h1>
    <form method="POST">
        <div class="form-group">
            <label for="section4_title">Titre de la section 4</label>
            <input type="text" id="section4_title" name="section4_title" value="<?php echo htmlspecialchars($page['section4_title']); ?>">
        </div>
        <div class="form-group">
            <label for="section4_text">Texte de la section 4</label>
            <textarea id="section4_text" name="section4_text"><?php echo htmlspecialchars($page['section4_text']); ?></textarea>
        </div>
        <button type="submit">Sauvegarder</button>
        <!-- Ajouter les autres sections de manière similaire -->
</body>
</html>
