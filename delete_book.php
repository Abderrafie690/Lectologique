<?php
include 'includes/header.php';
require 'includes/db.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Verificar si se ha pasado un ID de libro
if (!isset($_GET['id'])) {
    echo "ID du livre non fourni.";
    exit;
}

$book_id = (int)$_GET['id'];
$user_id = $_SESSION['user_id'];

try {
    // Asegurarse de que el libro pertenece al usuario
    $sql = "DELETE FROM bookss WHERE id = ? AND user_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$book_id, $user_id]);

    // Redirige a la lista de libros
    header("Location: view_books.php");
    exit;

} catch (PDOException $e) {
    echo "Erreur lors de la suppression du livre: " . $e->getMessage();
}
?>

