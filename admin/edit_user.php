<?php
session_start();
require '../includes/db.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    echo "Accès refusé.";
    exit;
}

if (isset($_GET['id'])) {
    $user_id = (int)$_GET['id'];

    $stmt = $pdo->prepare("SELECT id, username, email, role FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();

    if (!$user) {
        echo "Utilisateur non trouvé.";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $role = $_POST['role'];

        if (empty($username) || empty($email)) {
            $error = "Veuillez remplir tous les champs.";
        } else {
            $update = $pdo->prepare("UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?");
            $update->execute([$username, $email, $role, $user_id]);
            header("Location: manage_users.php");
            exit;
        }
    }
} else {
    echo "ID utilisateur manquant.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Modifier un utilisateur</title>
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

<!-- 📝 Formulaire -->
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-6">
      <div class="card shadow rounded-4">
        <div class="card-body p-5 bg-light">
          <h2 class="mb-4 text-center text-primary fw-bold">
            <i class="bi bi-pencil-square me-2"></i> Modifier l'utilisateur
          </h2>

          <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
          <?php endif; ?>

          <form action="edit_user.php?id=<?= $user['id'] ?>" method="POST">
            <div class="mb-3">
              <label for="username" class="form-label">👤 Nom d'utilisateur</label>
              <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">📧 Email</label>
              <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>
            <div class="mb-4">
              <label for="role" class="form-label">🔐 Rôle</label>
              <select class="form-select" id="role" name="role">
                <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>Utilisateur</option>
                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Administrateur</option>
              </select>
            </div>
            <div class="text-end">
              <button type="submit" class="btn btn-primary px-4">
                <i class="bi bi-check-lg me-1"></i> Enregistrer
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

