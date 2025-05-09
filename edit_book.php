<?php
session_start();
require 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    echo "ID du livre non fourni.";
    exit;
}

$book_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM bookss WHERE id = ? AND user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$book_id, $user_id]);
$book = $stmt->fetch();

if (!$book) {
    echo "Livre non trouvé ou vous n'avez pas la permission.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>✏️ Modifier un livre</title>
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

<!-- ✏️ Formulaire de modification -->
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card shadow rounded-4">
        <div class="card-body p-5 bg-light">
          <h2 class="text-center text-primary mb-4 fw-bold">
            <i class="bi bi-pencil-square me-2"></i> Modifier le livre
          </h2>

          <form action="edit_book_process.php" method="POST">
            <input type="hidden" name="id" value="<?= $book['id'] ?>">

            <div class="mb-3">
              <label for="title" class="form-label">📖 Titre</label>
              <input type="text" class="form-control" name="title" id="title"
                     value="<?= htmlspecialchars($book['title']) ?>" required>
            </div>

            <div class="mb-3">
              <label for="autor" class="form-label">✍️ Auteur</label>
              <input type="text" class="form-control" name="autor" id="autor"
                     value="<?= htmlspecialchars($book['Autor']) ?>" required>
            </div>

           

            <div class="text-end">
              <button type="submit" class="btn btn-primary px-4">
                <i class="bi bi-save2 me-1"></i> Enregistrer
              </button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
<?php include 'includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
