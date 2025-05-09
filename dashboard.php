<?php
session_start();
require 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$username = htmlspecialchars($_SESSION['username']);
$is_admin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Lectologique</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
</head>
<body>

<!-- 🔷 Barre de navigation colorée -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
    <div class="container">
        <a class="navbar-brand fw-bold" href="dashboard.php">
            📘 <span style="letter-spacing:1px;">Lectologique</span>
        </a>
        <div class="d-flex">
            <a href="logout.php" class="btn btn-outline-light">Se déconnecter</a>
        </div>
    </div>
</nav>

<!-- 🧑‍💻 Contenu principal -->
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-secondary">👋 Bienvenue <?= $username ?> !</h2>
        <p class="text-muted">Voici votre tableau de bord personnel.</p>
    </div>

    <div class="row g-4 justify-content-center">

        <!-- 📚 Mes livres -->
        <div class="col-md-4">
            <a href="view_books.php" class="text-decoration-none">
                <div class="card bg-info text-white text-center shadow-sm h-100">
                    <div class="card-body py-4">
                        <i class="bi bi-book-fill fs-1 mb-2"></i>
                        <h5 class="card-title">Mes livres</h5>
                    </div>
                </div>
            </a>
        </div>

        <!-- ➕ Ajouter un livre -->
        <div class="col-md-4">
            <a href="add_book.php" class="text-decoration-none">
                <div class="card bg-success text-white text-center shadow-sm h-100">
                    <div class="card-body py-4">
                        <i class="bi bi-plus-circle-fill fs-1 mb-2"></i>
                        <h5 class="card-title">Ajouter un livre</h5>
                    </div>
                </div>
            </a>
        </div>

        <!-- 🛡️ Dashboard admin (si admin) -->
        <?php if ($is_admin): ?>
        <div class="col-md-4">
            <a href="admin/admin.php" class="text-decoration-none">
                <div class="card bg-warning text-dark text-center shadow-sm h-100">
                    <div class="card-body py-4">
                        <i class="bi bi-shield-lock-fill fs-1 mb-2"></i>
                        <h5 class="card-title">Dashboard Admin</h5>
                    </div>
                </div>
            </a>
        </div>

        <!-- 👥 Gérer les utilisateurs (si admin) -->
        <div class="col-md-4">
            <a href="admin/manage_users.php" class="text-decoration-none">
                <div class="card bg-danger text-white text-center shadow-sm h-100">
                    <div class="card-body py-4">
                        <i class="bi bi-people-fill fs-1 mb-2"></i>
                        <h5 class="card-title">Gérer les utilisateurs</h5>
                    </div>
                </div>
            </a>
        </div>
        <?php endif; ?>

    </div>
</div>
<?php include 'includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
