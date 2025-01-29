<?php
class HomeController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function index() {
        // Définir les variables nécessaires pour la vue
        $is_logged_in = isset($_SESSION['user_id']);

        // Inclure uniquement la vue associée
        include __DIR__ . '/../view/home_page.phtml';
    }
}

$controller = new HomeController($pdo);
$controller->index();
