<?php
include __DIR__ . '/../config/db.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!$pdo) {
  die("Erreur de connexion à la base de données.");
}
include __DIR__ . '/../assets/header.php';
?>


<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Amigaru</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="output.css">
  <style>
    .separator {
      width: 50%;
      height: 4px;
      margin: 20px auto;
      background-color: #333;
      border-radius: 10px;
    }
  </style>
</head>

<body class="bg-neutral-900 text-white">

  <!-- Hero Section -->
  <section class="min-h-[80vh] flex flex-col justify-center items-center p-16" style="background-image: url('img/hero.png');
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
  width: 100%;
 ">
    <img src="img/logo_typo.png" alt="Logo Amigaru" class="mb-10 mt-10 lg:max-w-[75vh] h-auto">
    <p class="text-center text-lg lg:text-xl font-bold">Agence de Vtubeur Fr</p>
    <div class="mt-12 animate-bounce">
      <a href="#qui-sommes-nous" class="text-gray-600">
        <i class="fas fa-mouse text-3xl"></i>
      </a>
    </div>
  </section>

  <!-- Section 1 : Qui est Amigaru -->
  <section id="qui-sommes-nous"
    class="flex flex-col lg:flex-row items-center p-8 lg:px-[200px] lg:py-[100px] space-y-8 lg:space-y-0 lg:space-x-8">
    <div class="lg:w-1/2">
      <img src="img/illu.png" alt="Illustration Amigaru" class="rounded-lg shadow-lg w-full max-w-[150px] m-auto">
    </div>
    <div class="lg:w-1/2 text-left lg:text-left">
      <h2 class="text-3xl font-bold mb-4">Qui est Amigaru ?</h2>
      <p class="text-lg">
        Amigaru est une communauté dédiée à rassembler les streameurs et Vtubers francophones.
        Nous encourageons les créateurs à s'unir pour s'entraider, collaborer et grandir ensemble.
      </p>
    </div>
  </section>
  <div class="separator"></div>
  <!-- Section 2 : C'est quoi le Vtubing -->
  <section class="p-8 lg:px-[200px] lg:py-[100px]">
    <h2 class="text-3xl font-bold text-center mb-8">C'est quoi le Vtubing ?</h2>
    <p class="text-lg text-left max-w-2xl mx-auto">Le VTubing, vous en avez peut-être déjà entendu parler sans
      vraiment savoir ce que c’est. Eh bien, c’est tout simplement l’art de streamer en direct, mais sans se dévoiler
      physiquement sur le web !
    </p>
    </br>
    <div class="flex flex-wrap justify-center gap-8 mt-5 mb-5">
      <div class="w-24 h-24 rounded-full bg-fuchsia-500 shadow-lg flex items-center justify-center">
        <img src="img/gawrGura.png" alt="Vtuber 1" class="w-20 h-20 rounded-full">
      </div>
      <div class="w-24 h-24 rounded-full bg-green-400 shadow-lg flex items-center justify-center">
        <img src="img/ironMouse.png" alt="Vtuber 2" class="w-20 h-20 rounded-full">
      </div>
      <div class="w-24 h-24 rounded-full bg-yellow-300 shadow-lg flex items-center justify-center">
        <img src="img/morriCalliope.png" alt="Vtuber 3" class="w-20 h-20 rounded-full">
      </div>
    </div>
    </br>
    <p class="text-lg text-left max-w-2xl mx-auto">Pour mieux comprendre ce qu’est le VTubing (et ce qu’est un VTuber,
      le terme utilisé pour désigner les créateurs
      qui pratiquent cette activité), décomposons un peu le mot :</p>
    <ul class="text-lg text-left list-disc max-w-2xl mx-auto">
      <li>Le V de VTubing fait référence à “Virtuel”.</li>
      <li>Le Tuber est une référence à “YouTuber”, ces créateurs de contenu en ligne.</li>
    </ul>
  </section>
  <div class="separator"></div>
  <!-- Section 3 : Nos objectifs -->
  <section class="p-8 lg:px-[200px] lg:py-[100px]">
    <h2 class="text-3xl font-bold text-center mb-4">Nos Objectifs</h2>
    <p class="text-lg text-left max-w-2xl mx-auto mb-8">
      Notre projet a pour objectif de mettre en avant les VTubers français, de créer un espace où l'on peut s'amuser
      ensemble, et surtout, de faciliter l'accès des francophones à l'univers passionnant du VTubing.

      Rejoignez une communauté où créativité et divertissement se rencontrent, pour que chaque VTuber francophone trouve
      sa place et brille à sa manière !
    </p>

    <div class="separator"></div>
    <div class="mt-12 ">
      <h3 class="text-2xl font-bold text-center mb-4">Nos Vtubers</h3>
      <div class="flex overflow-x-auto space-x-4 flex-wrap justify-center">
        <div class="flex-none w-40 h-40 bg-gray-300 rounded-lg shadow-lg">
          <img src="img/goddesAkane.png" alt="Vtuber 4" class="w-full h-full rounded-lg">
        </div>
        <div class="flex-none w-40 h-40 bg-gray-300 rounded-lg shadow-lg">
          <img src="img/studioos.png" alt="Vtuber 5" class="w-full h-full rounded-lg">
        </div>
        <div class="flex-none w-40 h-40 bg-gray-300 rounded-lg shadow-lg">
          <img src="img/shyrrotsuki.png" alt="Vtuber 6" class="w-full h-full rounded-lg">
        </div>
        <div class="flex-none w-40 h-40">
          <button class="bg-blue-600 text-white py-2 px-4 rounded-lg shadow-lg hover:bg-blue-700 mt-[35%] mb-[35%]">Voir
            plus</button>
        </div>
      </div>
    </div>
  </section>
  <!-- Section 4 : Comment nous rejoindre -->
  <section class="p-8 lg:px-[200px] lg:py-[100px] bg-gray-800 rounded-t-[50px]">
    <h2 class="text-3xl font-bold text-center mb-4">Comment nous rejoindre ?</h2>
    <p class="text-lg text-left max-w-2xl mx-auto">
      Rejoindre Amigaru est simple ! Contactez-nous via nos réseaux sociaux ou notre serveur Discord.
      Découvrez une communauté dynamique et passionnée prête à vous accueillir.
    </p>
    <div class="text-center mt-8">
      <a href="#" class="bg-blue-600 text-white py-2 px-4 rounded-lg shadow-lg hover:bg-blue-700">
        Rejoignez-nous !
      </a>
    </div>
  </section>

</body>
<?php include __DIR__ . '/../assets/footer.php'; ?>

</html>