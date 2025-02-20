<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];

    try {
        $stmt = $pdo->prepare("INSERT INTO employes (pseudo, email) VALUES (:pseudo, :email)");
        $stmt->execute([':pseudo' => $pseudo, ':email' => $email]);
        echo "Employé ajouté avec succès.";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
