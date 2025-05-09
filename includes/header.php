<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$current = basename($_SERVER['PHP_SELF']);

// Depuración: Verifica si 'is_admin' está establecido en la sesión
// var_dump($_SESSION['is_admin']); // Descomenta esta línea para ver el valor de $_SESSION['is_admin']
// exit; // Descomenta esta línea para detener la ejecución del script temporalmente

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>📚 Lectologique</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="index.php">
    📚 Lectologique
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav ms-auto">
        <?php if (isset($_SESSION['user_id'])): ?>
          <!-- Enlace común para todos los usuarios -->
          <li class="nav-item">
            <a class="nav-link <?= $current === 'dashboard.php' ? 'active' : '' ?>" href="dashboard.php">
              <i class="bi bi-house-fill"></i> Accueil
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $current === 'view_books.php' ? 'active' : '' ?>" href="view_books.php">
              <i class="bi bi-book-fill"></i> Mes livres
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $current === 'add_book.php' ? 'active' : '' ?>" href="add_book.php">
              <i class="bi bi-plus-circle-fill"></i> Ajouter un livre
            </a>
          </li>

          <!-- Si el usuario es administrador, mostrar enlaces adicionales -->
          <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true): ?>
            <li class="nav-item">
            <a class="nav-link <?= $current === 'admin.php' ? 'active' : '' ?>" href="admin/admin.php">

                <i class="bi bi-shield-lock"></i> Dashboard Admin
              </a>
            </li>
            <li class="nav-item">
            <a class="nav-link <?= $current === 'manage_users.php' ? 'active' : '' ?>" href="admin/manage_users.php">

                <i class="bi bi-person-lines-fill"></i> Gérer les utilisateurs
              </a>
            </li>
          <?php endif; ?>

          <!-- Dropdown usuario -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle <?= in_array($current, ['dashboard.php','view_books.php','add_book.php']) ? 'active' : '' ?>"
               href="#" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-circle"></i> <?= htmlspecialchars($_SESSION['username']) ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
              <li>
                <a class="dropdown-item" href="edit_profile.php">
                  <i class="bi bi-pencil-fill"></i>  Modifier le profil
                </a>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <a class="dropdown-item text-danger" href="logout.php">
                  <i class="bi bi-box-arrow-right"></i> Se déconnecter
                </a>
              </li>
            </ul>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link <?= $current === 'register.php' ? 'active' : '' ?>" href="register.php">
              <i class="bi bi-pencil-square"></i> S'inscrire
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $current === 'login.php' ? 'active' : '' ?>" href="login.php">
              <i class="bi bi-box-arrow-in-right"></i> Se connecter
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<?php include 'includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

