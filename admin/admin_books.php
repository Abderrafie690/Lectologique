<?php
session_start();
require '../includes/db.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    echo "Accès refusé.";
    exit;
}

$stmt = $pdo->query("SELECT * FROM bookss ORDER BY id DESC");
$books = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des livres</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <!-- 🔷 Barre supérieure -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
  <div class="container">
    <a class="navbar-brand fw-bold" href="admin.php">🛡️ Lectologique Admin</a>
    <div class="d-flex">
      <a href="../dashboard.php" class="btn btn-outline-light me-2">
        <i class="bi bi-arrow-left-circle"></i> Accueil
      </a>
      <a href="../logout.php" class="btn btn-outline-light">
        <i class="bi bi-box-arrow-right"></i> Déconnexion
      </a>
    </div>
  </div>
</nav>

<div class="container py-5">
    <h2 class="mb-4 text-center"><i class="bi bi-journal-bookmark"></i> Gestion des livres</h2>

    <div class="mb-4 d-flex justify-content-between">
        <a href="admin.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Retour au menu
        </a>
        <a href="../logout.php" class="btn btn-danger">
            <i class="bi bi-box-arrow-right"></i> Déconnexion
        </a>
    </div>

    <table class="table table-striped table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Genre</th>
                <th>État</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($books as $book): ?>
            <tr>
                <td><?= $book['id'] ?></td>
                <td><?= htmlspecialchars($book['title']) ?></td>
                <td><?= htmlspecialchars($book['Autor']) ?></td>
                <td><?= htmlspecialchars($book['Genero']) ?></td>
                <td><?= htmlspecialchars($book['Estado']) ?></td>
                <td><?= htmlspecialchars($book['description']) ?></td>
                <td>
                    <a href="delete_book_admin.php?id=<?= $book['id'] ?>" class="btn btn-sm btn-danger"
                       onclick="return confirm('Supprimer ce livre ?')">
                        🗑️ Supprimer
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include '../includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
