<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);


// Définir le temps d'inactivité avant que la session ne soit fermée
ini_set('session.gc_maxlifetime', 1800); // 30 minutes

// Debug temporaire pour vérifier le contenu de $_SESSION
// (Supprime ces lignes après le test)
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

// Inclure la connexion à la base de données
require_once __DIR__ . '/models/connectModel.php';

// Vérifier si l'utilisateur est connecté et s'il est streameur
$is_logged_in = !empty($_SESSION['user_id']);
$is_streamer = !empty($_SESSION['role']) && $_SESSION['role'] === 'streameur';

// Sécuriser la variable GET en autorisant uniquement des noms de fichiers valides
$allowed_pages = ['home', 'our_members', 'login'];
$page = isset($_GET['page']) && in_array($_GET['page'], $allowed_pages) ? $_GET['page'] : 'home';

// Chemin du fichier contrôleur correspondant
$controller_file = __DIR__ . "/controller/{$page}.controller.php";

// Vérifier si le fichier contrôleur existe avant de l'inclure
if (file_exists($controller_file)) {
    require_once $controller_file;
} else {
    require_once __DIR__ . '/view/404.phtml';
}
