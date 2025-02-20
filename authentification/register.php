<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $password = password_hash($_POST['mot_de_passe'], PASSWORD_BCRYPT);  // Hash du mot de passe

    try {
        $stmt = $pdo->prepare("INSERT INTO utilisateur (pseudo, email, mot_de_passe, role) VALUES (:pseudo, :email, :password, 'passager')");
        $stmt->execute([
            ':pseudo' => $pseudo,
            ':email' => $email,
            ':password' => $password
        ]);
        echo "Inscription réussie !";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
