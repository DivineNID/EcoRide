<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $utilisateur_id = $_SESSION['utilisateur_id'];
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];

    try {
        $stmt = $pdo->prepare("UPDATE utilisateur SET pseudo = :pseudo, email = :email WHERE id = :id");
        $stmt->execute([
            ':pseudo' => $pseudo,
            ':email' => $email,
            ':id' => $utilisateur_id
        ]);
        echo "Profil mis à jour avec succès.";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
