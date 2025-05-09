 
<?php
// Connexion à la BDD
$host = 'localhost';
$db = 'Lectologique_db';
$user = 'root';
$pass = ''; // Por defecto en XAMPP no hay contraseña

try {
  $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Error de conexión: " . $e->getMessage());
}
?>
