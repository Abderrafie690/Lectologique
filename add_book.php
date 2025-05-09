<?php
session_start();
require 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Procesar formulario (igual que antes)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $autor = trim($_POST['autor']);
    $genero = trim($_POST['genero']);
    $estado = $_POST['estado'];
    $description = trim($_POST['description']);
    $user_id = $_SESSION['user_id'];

    if (empty($title) || empty($autor) || empty($estado)) {
        $error = "Por favor completa todos los campos obligatorios.";
    } else {
        $cover_path = null;
        if (isset($_FILES['cover']) && $_FILES['cover']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            $fileTmp = $_FILES['cover']['tmp_name'];
            $fileName = basename($_FILES['cover']['name']);
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'webp'];

            if (in_array($fileExt, $allowed)) {
                $newName = uniqid('book_') . '.' . $fileExt;
                $destPath = $uploadDir . $newName;

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                if (move_uploaded_file($fileTmp, $destPath)) {
                    $cover_path = $destPath;
                } else {
                    $error = "Erreur lors de l'upload de l'image.";
                }
            } else {
                $error = "Format d'image non autorisé.";
            }
        }

        if (!isset($error)) {
            try {
                $sql = "INSERT INTO bookss (user_id, title, autor, genero, estado, description, cover_path)
                        VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$user_id, $title, $autor, $genero, $estado, $description, $cover_path]);
                header("Location: dashboard.php?add=success");
                exit;
            } catch (PDOException $e) {
                $error = "Error al guardar el libro: " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un livre</title>
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

<!-- 📝 Formulario -->
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card border-0 shadow-lg rounded-4">
        <div class="card-body p-5 bg-light">
          <h2 class="mb-4 text-center text-primary fw-bold">
            <i class="bi bi-journal-plus me-2"></i> Ajouter un nouveau livre
          </h2>

          <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
          <?php endif; ?>

          <form action="add_book.php" method="POST" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="title" class="form-label">📖 Titre</label>
                <input type="text" class="form-control border-primary" id="title" name="title" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="autor" class="form-label">✍️ Auteur</label>
                <input type="text" class="form-control border-primary" id="autor" name="autor" required>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="genero" class="form-label">📚 Genre</label>
                <input type="text" class="form-control border-success" id="genero" name="genero">
              </div>
              <div class="col-md-6 mb-3">
                <label for="estado" class="form-label">📌 État</label>
                <select class="form-select border-warning" id="estado" name="estado">
                  <option value="Non lu">Non lu</option>
                  <option value="En lecture">En lecture</option>
                  <option value="Lu">Lu</option>
                </select>
              </div>
            </div>

            <div class="mb-3">
              <label for="description" class="form-label">📝 Description</label>
              <textarea class="form-control border-info" id="description" name="description" rows="3"></textarea>
            </div>

            <div class="mb-4">
              <label for="cover" class="form-label">🖼️ Image de couverture (facultatif)</label>
              <input class="form-control" type="file" id="cover" name="cover">
            </div>

            <div class="text-end">
              <button type="submit" class="btn btn-primary px-4">
                <i class="bi bi-plus-circle me-1"></i> Enregistrer le livre
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



