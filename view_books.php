<?php
session_start();
require 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM bookss WHERE user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$bookss = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes livres</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<!-- 🔷 Barre supérieure -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
  <div class="container">
    <a class="navbar-brand fw-bold" href="dashboard.php">📘 Lectologique</a>
    <div class="d-flex">
      <a href="dashboard.php" class="btn btn-outline-light me-2">
        <i class="bi bi-house-fill"></i> Accueil
      </a>
      <a href="logout.php" class="btn btn-outline-light">
        <i class="bi bi-box-arrow-right"></i> Déconnexion
      </a>
    </div>
  </div>
</nav>

<!-- 📚 Contenu principal -->
<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-primary">📚 Mes livres</h2>
    <a href="add_book.php" class="btn btn-success">
      <i class="bi bi-plus-circle me-1"></i> Ajouter un nouveau livre
    </a>
  </div>

  <div class="row row-cols-1 row-cols-md-3 g-4">
    <?php if ($bookss): ?>
      <?php foreach ($bookss as $book): ?>
        <div class="col">
          <div class="card h-100 shadow-sm border-0">
            <?php if (!empty($book['cover_path'])): ?>
              <img src="<?= htmlspecialchars($book['cover_path']) ?>" class="card-img-top" style="height: 250px; object-fit: cover;" alt="Portada del livre">
            <?php else: ?>
              <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 250px;">
                <span>Sans image</span>
              </div>
            <?php endif; ?>

            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($book['title']) ?></h5>
              <p class="card-text mb-1"><strong>Auteur:</strong> <?= htmlspecialchars($book['Autor']) ?></p>
              <p class="card-text mb-1"><strong>Genre:</strong> <?= htmlspecialchars($book['Genero']) ?></p>
              <p class="card-text mb-2"><strong>État:</strong> <?= htmlspecialchars($book['Estado']) ?></p>
              <?php if (!empty($book['description'])): ?>
                <p class="text-muted small"><?= nl2br(htmlspecialchars($book['description'])) ?></p>
              <?php endif; ?>
            </div>

            <div class="card-footer bg-light d-flex justify-content-between">
              
              <div class="card-footer d-flex justify-content-between flex-wrap gap-2">
  <a href="book.php?id=<?= $book['id'] ?>" class="btn btn-sm btn-outline-secondary">
    🔍 Voir le livre
  </a>
  <a href="edit_book.php?id=<?= $book['id'] ?>" class="btn btn-sm btn-primary">
    ✏️ Éditer
  </a>
  <a href="delete_book.php?id=<?= $book['id'] ?>" class="btn btn-sm btn-danger"
     onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ?')">🗑️ Supprimer</a>
</div>

            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p class="text-center text-muted">Vous n'avez pas encore de livres enregistrés.</p>
    <?php endif; ?>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
