<?php
session_start();
require 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Validar datos del formulario
if (isset($_POST['id'], $_POST['title'], $_POST['autor'])) {
    $book_id = (int)$_POST['id'];
    $title = trim($_POST['title']);
    $autor = trim($_POST['autor']);
    $user_id = $_SESSION['user_id'];

    // Validación simple
    if (empty($title) || empty($autor)) {
        $error = "Tous les champs sont obligatoires.";
    } else {
        try {
            $stmt = $pdo->prepare("UPDATE bookss SET title = ?, autor = ? WHERE id = ? AND user_id = ?");
            $stmt->execute([$title, $autor, $book_id, $user_id]);
            header("Location: view_books.php?edit=success");
            exit;
        } catch (PDOException $e) {
            $error = "Erreur lors de la mise à jour : " . $e->getMessage();
        }
    }
} else {
    $error = "Formulaire invalide.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Erreur de modification</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container py-5">
    <div class="alert alert-danger text-center">
      <h4 class="mb-3">❌ Une erreur est survenue</h4>
      <p><?= isset($error) ? htmlspecialchars($error) : "Erreur inconnue." ?></p>
      <a href="view_books.php" class="btn btn-primary mt-3">⬅ Retour à mes livres</a>
    </div>
  </div>
  <?php include 'includes/footer.php'; ?>
</body>
</html>
