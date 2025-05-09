<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Créer un compte - Lectologique</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<!-- 🔷 Barre supérieure -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">📘 Lectologique</a>
  </div>
</nav>

<!-- 📝 Formulaire d'inscription -->
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      <div class="card shadow border-0 rounded-4">
        <div class="card-body p-4 bg-light">
          <h2 class="text-center mb-4 text-primary fw-bold">
            <i class="bi bi-pencil-square me-2"></i> Créer un compte
          </h2>

          <form action="register_process.php" method="POST">
            <div class="mb-3">
              <label for="username" class="form-label">👤 Nom d'utilisateur</label>
              <input type="text" class="form-control" name="username" id="username" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">📧 Adresse e-mail</label>
              <input type="email" class="form-control" name="email" id="email" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">🔒 Mot de passe</label>
              <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <div class="d-grid mt-4">
              <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle me-1"></i> S'inscrire
              </button>
            </div>
          </form>

          <p class="text-center mt-4">
            Déjà un compte ? <a href="login.php">Se connecter</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include 'includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



