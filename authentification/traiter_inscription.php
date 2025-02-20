<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    try {
        // Insertion de l'utilisateur avec 20 crédits
        $stmt = $pdo->prepare("INSERT INTO utilisateur (pseudo, email, mot_de_passe, credits) 
                               VALUES (:pseudo, :email, :mot_de_passe, 20)");
        $stmt->execute([
            ':pseudo' => $pseudo,
            ':email' => $email,
            ':mot_de_passe' => $password
        ]);

        echo "Inscription réussie ! Vous avez reçu 20 crédits.";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo "Méthode non autorisée.";
}
?>
