<?php
require 'includes/db.php'; // Conexión a la base de datos

// Verificar que los campos del formulario existen
if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validación básica (puedes mejorarla)
    if (empty($username) || empty($email) || empty($password)) {
        echo "Tous les champs sont obligatoires.";
        exit;
    }

    // Hashear la contraseña (muy importante)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insertar en la base de datos
    try {
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $email, $hashedPassword]);

        // Redirigir al login
        header("Location: login.php");
        exit;

    } catch (PDOException $e) {
        // Si el email ya existe, por ejemplo
        echo "Erreur lors de l'enregistrement: " . $e->getMessage();
    }
} else {
    echo "Formulaire invalide.";
}
?>


