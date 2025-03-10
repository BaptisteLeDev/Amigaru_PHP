<header class="fixed z-50 top-0 left-0 right-0 px-4 py-3 bg-gradient-to-r shadow-lg rounded-lg mt-5 mx-auto max-w-[80%]"
  style="
  background: rgba(255, 255, 255, 0.2);
border-radius: 16px;
box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
backdrop-filter: blur(5px);
-webkit-backdrop-filter: blur(5px);
border: 1px solid rgba(255, 255, 255, 0.3);">
  <div class="flex justify-between items-center">
    <!-- Logo -->
    <a href="index.php" class="text-xl font-bold text-white hover:text-neutral-900">⭐ Amigaru</a>

    <!-- Bouton burger pour mobile -->
    <button class="lg:hidden text-white focus:outline-none" onclick="toggleMenu()">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>

    <!-- Liens de navigation (Desktop) -->
    <nav class="hidden lg:flex items-center justify-between space-x-6 ">
      <ul class="flex items-center space-x-6">
        <li><a href="nos_membres.php" class="text-white font-semibold hover:text-neutral-900">Nos Membres</a></li>
        <li><a href="rejoindre.php" class="text-white font-semibold hover:text-neutral-900">Nous Rejoindre</a></li>
        <li><a href="#" class="text-white font-semibold hover:text-neutral-900">Nous Contacter</a></li>
      </ul>
      <?php if (isset($is_logged_in) && $is_logged_in): ?>
        <a href="membre_edition.php?id=<?= $_SESSION['user_id']; ?>">
          <button
            class="flex items-center gap-2 px-4 py-2 bg-white text-black font-bold rounded-full hover:bg-neutral-900 hover:text-white">
            Édition <span class="text-lg">🖌️</span>
          </button>
        </a>
      <?php else: ?>
        <a href="login.php">
          <button
            class="flex items-center gap-2 px-4 py-2 bg-white text-black font-bold rounded-full hover:bg-neutral-900 hover:text-white">
            Compte Étoile <span class="text-lg">✨</span>
          </button>
        </a>
      <?php endif; ?>
    </nav>
  </div>

  <!-- Menu Mobile -->
  <div id="mobile-menu" class="hidden flex-col mt-4 space-y-4 lg:hidden">
    <ul class="space-y-2">
      <li><a href="nos_membres.php" class="block text-white font-semibold hover:text-neutral-900 text-left">Nos Membres</a></li>
      <li><a href="rejoindre.php" class="block text-white font-semibold hover:text-neutral-900 text-left">Nous Rejoindre</a></li>
      <li><a href="#" class="block text-white font-semibold hover:text-neutral-900 text-left">Nous Contacter</a></li>
    </ul>
    <?php if (isset($is_logged_in) && $is_logged_in): ?>
      <a href="membre_edition.php?id=<?= $_SESSION['user_id']; ?>">
        <button
          class="flex items-center gap-2 px-4 py-2 bg-white text-black font-bold rounded-full hover:bg-neutral-900 hover:text-white">
          Édition <span class="text-lg">🖌️</span>
        </button>
      </a>
    <?php else: ?>
      <a href="login.php">
        <button
          class="flex items-center gap-2 px-4 py-2 bg-white text-black font-bold rounded-full hover:bg-neutral-900 hover:text-white">
          Compte Étoile <span class="text-lg">✨</span>
        </button>
      </a>
    <?php endif; ?>
  </div>
</header>

<script>
  // Script pour basculer le menu mobile
  function toggleMenu() {
    const menu = document.getElementById('mobile-menu');
    menu.classList.toggle('hidden');
  }
</script>