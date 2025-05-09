<?php
session_start();
require '../includes/db.php';

// Verificar si el usuario tiene acceso de administrador
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    echo "Acceso no autorizado.";
    exit;
}

// Verificar si se pasó el ID del usuario
if (isset($_GET['id'])) {
    $user_id = (int)$_GET['id'];

    // Comprobar si el usuario existe
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();

    if ($user) {
        // Eliminar el usuario
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id]);

        header("Location: admin_users.php"); // Redirigir al listado de usuarios
        exit;
    } else {
        echo "El usuario no existe.";
    }
} else {
    echo "No se ha proporcionado un ID de usuario.";
}
?>
