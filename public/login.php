<?php
session_start();
$is_logged_in = isset($_SESSION['user_id']);
include __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = $pdo->prepare("SELECT * FROM user WHERE email = :email");
    $query->execute(['email' => $email]);
    $user = $query->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: membre_edition.php?id=".$user['id']);
        exit;
    } else {
        $error = "Identifiants incorrects.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-neutral-900 text-white">
    <form action="" method="POST" class="max-w-md mx-auto mt-10 bg-neutral-800 p-6 rounded-lg">
        <h1 class="text-2xl font-bold mb-4">Connexion</h1>
        <?php if (!empty($error)): ?>
            <p class="text-red-500"><?php echo $error; ?></p>
        <?php endif; ?>
        <input type="email" name="email" placeholder="Email" required class="w-full mb-4 p-2 rounded text-black">
        <input type="password" name="password" placeholder="Mot de passe" required class="w-full mb-4 p-2 rounded text-black">
        <button type="submit" class="w-full bg-blue-500 p-2 rounded text-white hover:bg-blue-600">Se connecter</button>
    </form>
</body>
</html>
