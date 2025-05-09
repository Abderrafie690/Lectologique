<?php
include 'includes/header.php';
require 'includes/db.php';

if (isset($_POST['email'], $_POST['password'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    

    // Buscar al usuario por email
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Contraseña correcta, iniciar sesión
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        if ($user['role'] === 'admin') {
            $_SESSION['is_admin'] = true;
        } else {
            $_SESSION['is_admin'] = false;
        }
        
        header("Location: dashboard.php");
        exit;
    } else {
        echo "E-mail ou mot de passe incorrect.";
    }
} else {
    echo "Formulaire invalide.";
}
?>

