<?php
// Démarrage de la session
session_start();

// Inclusion de la configuration de la base de données
require_once 'db.php';

// Vérification si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération et sécurisation des données envoyées par le formulaire
    $pseudo = htmlspecialchars(trim($_POST['pseudo']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];
    $passwordConfirm = $_POST['password_confirm'];

    // Vérification si tous les champs sont remplis
    if (empty($pseudo) || empty($email) || empty($password) || empty($passwordConfirm)) {
        $_SESSION['error'] = "Tous les champs sont obligatoires.";
        header("Location: signup.html");
        exit();
    }

    // Vérification si le mot de passe est sécurisé (longueur et caractères)
    if (strlen($password) < 8 || !preg_match("/[A-Z]/", $password) || !preg_match("/\d/", $password)) {
        $_SESSION['error'] = "Le mot de passe doit contenir au moins 8 caractères, une majuscule et un chiffre.";
        header("Location: signup.html");
        exit();
    }

    // Vérification de la correspondance des mots de passe
    if ($password !== $passwordConfirm) {
        $_SESSION['error'] = "Les mots de passe ne correspondent pas.";
        header("Location: signup.html");
        exit();
    }

    // Vérification si l'email est valide
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Adresse email invalide.";
        header("Location: signup.html");
        exit();
    }

    // Vérification si l'email ou le pseudo existent déjà
    $query = $db->prepare("SELECT * FROM utilisateurs WHERE email = ? OR pseudo = ?");
    $query->execute([$email, $pseudo]);
    if ($query->rowCount() > 0) {
        $_SESSION['error'] = "Email ou pseudo déjà utilisé.";
        header("Location: signup.html");
        exit();
    }

    // Hashage du mot de passe
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insertion de l'utilisateur dans la base de données avec 20 crédits de départ
    $insertQuery = $db->prepare("
        INSERT INTO utilisateurs (pseudo, email, mot_de_passe, credits) 
        VALUES (?, ?, ?, ?)
    ");
    if ($insertQuery->execute([$pseudo, $email, $hashedPassword, 20])) {
        $_SESSION['success'] = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
        header("Location: login_form.html");
        exit();
    } else {
        $_SESSION['error'] = "Une erreur est survenue. Veuillez réessayer.";
        header("Location: signup.html");
        exit();
    }
} else {
    // Redirection si l'utilisateur tente d'accéder directement à ce script
    header("Location: signup.html");
    exit();
}
?>
