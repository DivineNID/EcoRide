<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoRide - Covoiturage écologique</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" type="image/png" href="assets/images/favicon.png">
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <a href="index.php"><img src="assets/images/logo.png" alt="EcoRide"></a>
            </div>
            <ul class="nav-links">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="liste_covoiturages.php">Trajets</a></li>
                <li><a href="contact.php">Contact</a></li>
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <li><a href="profil.php">Mon Profil</a></li>
                    <li><a href="logout.php" class="btn-logout">Déconnexion</a></li>
                <?php else : ?>
                    <li><a href="login.php" class="btn-login">Connexion</a></li>
                    <li><a href="register.php" class="btn-register">Inscription</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
