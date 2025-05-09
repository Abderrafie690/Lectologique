<?php
session_start();
include 'includes/header.php'; // Aquí ya está tu <head> y el inicio del <body>
?>

<!-- Estilos personalizados -->
<style>
  body {
    font-family: 'Inter', sans-serif;
  }
  .hero-bg {
    background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
  }
  .btn, .nav-link {
    transition: all 0.3s ease;
  }
  .btn:hover {
    transform: scale(1.02);
  }
  .feature-card {
    transition: all 0.3s ease;
  }
  .feature-card:hover {
    box-shadow: 0 0 10px rgba(0,0,0,0.12);
    transform: translateY(-3px);
  }
</style>

<!-- Hero principal -->
<section class="hero-bg py-5 text-center">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-md-6 mb-4 mb-md-0">
        <h1 class="display-4 fw-bold">Bienvenue sur Lectologique📚</h1>
        <p class="lead">Votre bibliothèque personnelle en ligne. Organisez, explorez et prenez soin de vos livres préférés avec style.</p>
        <?php if (!isset($_SESSION['user_id'])): ?>
          <a href="register.php" class="btn btn-primary btn-lg me-2 shadow-sm">Registrarse</a>
          <a href="login.php" class="btn btn-outline-secondary btn-lg shadow-sm">Se connecter</a>
        <?php else: ?>
          <a href="dashboard.php" class="btn btn-success btn-lg shadow-sm">Aller au panneau</a>
        <?php endif; ?>
      </div>
      <div class="col-md-6">
        <img src="assets/css/js/images/undraw_creative-flow_t3kz.png" alt="Lectura ilustrada" class="img-fluid" style="max-height: 350px;">
      </div>
    </div>
  </div>
</section>
<!-- CARRUSEL DE LIBROS RECIENTES -->
<section class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center mb-4">📖Derniers livres ajoutés</h2>
    <div id="carouselBooks" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active text-center">
          <img src="assets/css/js/images/book1.jpg" class="d-block mx-auto rounded shadow" style="height: 250px;" alt="Libro 1">
          <h5 class="mt-3">El Principito</h5>
        </div>
        <div class="carousel-item text-center">
          <img src="assets/css/js/images/book2.jpg" class="d-block mx-auto rounded shadow" style="height: 250px;" alt="Libro 2">
          <h5 class="mt-3">1984 - George Orwell</h5>
        </div>
        <div class="carousel-item text-center">
          <img src="assets/css/js/images/book3.jpg" class="d-block mx-auto rounded shadow" style="height: 250px;" alt="Libro 3">
          <h5 class="mt-3">Cien años de soledad</h5>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselBooks" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselBooks" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>
  </div>
</section>

<!-- TESTIMONIOS -->
<section class="py-5 bg-white">
  <div class="container">
    <h2 class="text-center mb-5">✨ Avis de nos utilisateurs</h2>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="p-4 shadow-sm rounded bg-light text-center">
          <img src="assets/css/js/images/user1.png" class="rounded-circle mb-3" width="80">
          <p class="fw-semibold">"Lectologique m'a aidé à organiser toute ma collection numérique. Recommandé !"</p>
          <p class="text-muted mb-0">– María, estudiante</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="p-4 shadow-sm rounded bg-light text-center">
          <img src="assets/css/js/images/user2.jpg" class="rounded-circle mb-3" width="80">
          <p class="fw-semibold">"Facile à utiliser, visuel et très utile pour les amoureux des livres."</p>
          <p class="text-muted mb-0">– Carlos, bibliotecario</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="p-4 shadow-sm rounded bg-light text-center">
          <img src="assets/css/js/user3.png" class="rounded-circle mb-3" width="80">
          <p class="fw-semibold">"Grâce à Lectologique, je n'oublie plus quels livres j'ai lus."</p>
          <p class="text-muted mb-0">– Ana, lectora frecuente</p>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- Sección de funcionalidades -->
<section class="py-5 bg-light">
  <div class="container text-center">
    <h2 class="mb-5 fw-bold">¿Que pouvez-vous faire avec <span class="text-primary">Lectologique</span>?</h2>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="p-4 bg-white rounded-4 shadow-sm h-100 border border-primary-subtle">
          <i class="bi bi-journal-check display-4 text-primary mb-3"></i>
          <h4 class="fw-semibold">Gérez vos livres</h4>
          <p class="text-muted">Ajoutez, éditez et supprimez des livres facilement depuis votre panneau personnel.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="p-4 bg-white rounded-4 shadow-sm h-100 border border-success-subtle">
          <i class="bi bi-folder-symlink-fill display-4 text-success mb-3"></i>
          <h4 class="fw-semibold">Organisez votre bibliothèque</h4>
          <p class="text-muted">Catégorisez vos lectures et gardez toujours vos favoris à portée de main.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="p-4 bg-white rounded-4 shadow-sm h-100 border border-warning-subtle">
          <i class="bi bi-cloud-arrow-up-fill display-4 text-warning mb-3"></i>
          <h4 class="fw-semibold">Accédez depuis n'importe où</h4>
          <p class="text-muted">Votre bibliothèque est dans le cloud : sûre, accessible et privée.</p>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- Pie de página -->
<footer class="text-center py-4 bg-light mt-5">
  <p class="mb-0">&copy; <?= date("Y") ?> Lectologique. Tous droits réservés.</p>
</footer>
<?php include 'includes/footer.php'; ?>
</body>
</html>


