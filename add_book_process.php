<?php
include 'includes/header.php';
require 'includes/db.php';

// Verifica que el usuario haya iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Verifica que se hayan enviado todos los campos del formulario
if (isset($_POST['title'], $_POST['author'], $_POST['year'])) {
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $year = (int)$_POST['year'];
    $user_id = $_SESSION['user_id'];

    // Validación básica
    if (empty($title) || empty($author) || empty($year)) {
        echo "Tous les champs sont obligatoires.";
        exit;
    }

    try {
        $sql = "INSERT INTO bookss (title, author, year, user_id) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $author, $year, $user_id]);

        // Redirige al dashboard o a la lista de libros
        header("Location: dashboard.php");
        exit;

    } catch (PDOException $e) {
        echo "Erreur lors de l’enregistrement du livre: " . $e->getMessage();
    }
} else {
    echo "Formulaire invalide.";
}
?>
