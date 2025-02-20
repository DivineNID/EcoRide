<?php
// Configuration des paramètres de connexion
$host = 'localhost';
$dbname = 'ecoride';
$username = 'root';  // Remplacer par votre utilisateur MySQL
$password = 'NIdivine219##'; // Remplacer par votre mot de passe MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
