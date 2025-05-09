<?php
session_start();
require 'includes/db.php';

if (!isset($_GET['id'])) {
    echo "Aucun livre spécifié.";
    exit;
}

$book_id = (int)$_GET['id'];

// Obtenir les informations du livre
$stmt = $pdo->prepare("SELECT b.*, u.username FROM bookss b JOIN users u ON b.user_id = u.id WHERE b.id = ?");
$stmt->execute([$book_id]);
$book = $stmt->fetch();

if (!$book) {
    echo "Livre introuvable.";
    exit;
}

// Ajouter un commentaire
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'], $_POST['comment'])) {
    $comment = trim($_POST['comment']);
    if (!empty($comment) && strlen($comment) <= 500) {
        $stmt = $pdo->prepare("INSERT INTO comments (book_id, user_id, content) VALUES (?, ?, ?)");
        $stmt->execute([$book_id, $_SESSION['user_id'], $comment]);
        header("Location: book.php?id=$book_id");
        exit;
    } else {
        $error = "Le commentaire est vide ou dépasse 500 caractères.";
    }
}

// Récupérer les commentaires
$comments = $pdo->prepare("
    SELECT c.*, u.username 
    FROM comments c 
    JOIN users u ON c.user_id = u.id 
    WHERE c.book_id = ? 
    ORDER BY c.created_at DESC
");
$comments->execute([$book_id]);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($book['title']) ?> - Lectologique</title>
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
        <i class="bi bi-arrow-left-circle"></i> Accueil
      </a>
      <a href="logout.php" class="btn btn-outline-light">
        <i class="bi bi-box-arrow-right"></i> Déconnexion
      </a>
    </div>
  </div>
</nav>

<!-- 📖 Contenu du livre -->
<div class="container py-5">
  <div class="mb-4">
    <h2 class="fw-bold text-primary"><?= htmlspecialchars($book['title']) ?></h2>
    <p><strong>Auteur:</strong> <?= htmlspecialchars($book['Autor']) ?></p>
    <p><strong>Genre:</strong> <?= htmlspecialchars($book['Genero']) ?></p>
    <p><strong>État:</strong> <?= htmlspecialchars($book['Estado']) ?></p>
    <?php if (!empty($book['description'])): ?>
      <p class="text-muted"><?= nl2br(htmlspecialchars($book['description'])) ?></p>
    <?php endif; ?>
    <hr>
  </div>

  <!-- 💬 Commentaires -->
  <div>
    <h4 class="mb-4">💬 Commentaires</h4>

    <?php foreach ($comments as $c): ?>
      <div class="mb-3 p-3 bg-light border rounded">
        <p class="mb-1">
          <strong><?= htmlspecialchars($c['username']) ?></strong>
          <small class="text-muted"><?= $c['created_at'] ?></small>
        </p>
        <p class="mb-0"><?= nl2br(htmlspecialchars($c['content'])) ?></p>
      </div>
    <?php endforeach; ?>

    <?php if (isset($_SESSION['user_id'])): ?>
      <div class="mt-5">
        <h5>Ajouter un commentaire :</h5>
        <?php if (isset($error)): ?>
          <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST">
          <div class="mb-3">
            <textarea class="form-control" name="comment" rows="3" maxlength="500" required
                      placeholder="Votre commentaire (max 500 caractères)..."></textarea>
          </div>
          <button type="submit" class="btn btn-primary">
            <i class="bi bi-send-fill me-1"></i> Publier
          </button>
        </form>
      </div>
    <?php else: ?>
      <p class="text-muted">🔐 Vous devez être connecté pour laisser un commentaire.</p>
    <?php endif; ?>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
