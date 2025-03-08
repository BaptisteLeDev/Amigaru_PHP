<?php
session_start();
$is_logged_in = isset($_SESSION['user_id']);
include __DIR__ . '/../config/db.php';
include __DIR__ . '/../assets/header.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nous Rejoindre - Amigaru</title>
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
        <h1 class="text-4xl font-bold mb-4 mt-10">Nous rejoindre ?</h1>
        <p class="text-lg">Découvrez les avantages de rejoindre notre communauté</p>
    </section>

    <!-- Section Pourquoi nous rejoindre -->
    <section class="p-8 lg:px-[200px] lg:py-[100px]">
        <h2 class="text-3xl font-bold text-center mb-8">Pourquoi nous rejoindre ?</h2>
        <p class="text-lg text-left max-w-2xl mx-auto mb-8">
            Rejoindre Amigaru, c'est intégrer une communauté dynamique et passionnée de VTubers francophones. 
            Vous bénéficierez de nombreux avantages tels que :
        </p>
        <ul class="text-lg text-left list-disc max-w-2xl mx-auto mb-8">
            <li>Accès à des ressources exclusives pour améliorer vos streams.</li>
            <li>Opportunités de collaboration avec d'autres créateurs de contenu.</li>
            <li>Support et conseils de la part de membres expérimentés.</li>
            <li>Participation à des événements et des concours organisés par la communauté.</li>
        </ul>
    </section>

    <!-- Formulaire de contact -->
    <section class="p-8 lg:px-[200px] lg:py-[100px] bg-neutral-800 rounded-t-[50px]">
        <h2 class="text-3xl font-bold text-center mb-8">Contactez-nous</h2>
        <form action="contact_submit.php" method="POST" class="bg-gray-800 p-6 rounded-lg shadow-md space-y-8 max-w-2xl mx-auto">
            <div>
                <label for="name" class="block text-lg font-semibold mb-2">Nom</label>
                <input type="text" id="name" name="name" required class="w-full p-3 rounded-md bg-gray-700 text-white focus:ring focus:ring-blue-500">
            </div>
            <div>
                <label for="email" class="block text-lg font-semibold mb-2">Email</label>
                <input type="email" id="email" name="email" required class="w-full p-3 rounded-md bg-gray-700 text-white focus:ring focus:ring-blue-500">
            </div>
            <div>
                <label for="message" class="block text-lg font-semibold mb-2">Message</label>
                <textarea id="message" name="message" rows="4" required class="w-full p-3 rounded-md bg-gray-700 text-white focus:ring focus:ring-blue-500"></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="px-6 py-3 bg-blue-600 rounded-lg text-white font-semibold shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Envoyer
                </button>
            </div>
        </form>
    </section>

    <?php include __DIR__ . '/../assets/footer.php'; ?>
</body>
</html>