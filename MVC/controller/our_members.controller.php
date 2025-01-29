<?php
class OurMembersController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function index() {
        // Récupérer les membres depuis la base de données
        $query = "SELECT id, username FROM user WHERE role = 'streamer'";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $streamers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Inclure uniquement la vue associée
        include __DIR__ . '/../view/our_members.phtml';
    }
}

$controller = new OurMembersController($pdo);
$controller->index();
