<?php
session_start();
require '../includes/db.php';

// Verifica si el usuario tiene acceso de administrador
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    echo "Accès refusé.";
    exit;
}

// Consulta todos los usuarios
$sql = "SELECT id, username, email, role FROM users";
$stmt = $pdo->query($sql);
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin - Gestion des utilisateurs</title>
    <link rel="stylesheet" href="../estilos.css">
</head>
<body>
    <div class="container py-5">
        <h2 class="text-center mb-4">👤 Gestion des utilisateurs</h2>

        <table border="1" cellpadding="10" cellspacing="0" style="width:100%;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom d'utilisateur</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['role']) ?></td>
                    <td>
                        <a href="edit_user.php?id=<?= $user['id'] ?>">✏️ Editar</a> |
                        <a href="delete_user.php?id=<?= $user['id'] ?>" onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?')">🗑️ Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
